<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class DatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::all();

        if ($datasets->isEmpty()) {
            return back()->withErrors('Dataset is empty.');
        }

        // Kelompokkan data berdasarkan kelulusan
        $grouped = $datasets->groupBy('kelulusan');
        $totalData = $datasets->count();

        // Hitung probabilitas prior
        $prior = $grouped->map(fn($group) => $group->count() / $totalData);

        // Hitung probabilitas atribut
        $attributes = ['status_pekerjaan', 'ipk_kategori', 'status_pembayaran'];
        $probabilities = $this->calculateAttributeProbabilities($grouped, $attributes);

        // Evaluasi akurasi
        $accuracy = $this->evaluateAccuracy($datasets, $grouped, $attributes, $prior);

        return view('dataset.index', compact('datasets', 'prior', 'probabilities', 'accuracy'));
    }



    public function home()
    {
    
        return view('home');
    }
    

    public function dataset()
    {
        // Ambil semua data dari tabel datasets
        $datasets = Dataset::all();
    
        // Mendapatkan semua kolom dari tabel datasets
        $columns = DB::getSchemaBuilder()->getColumnListing('datasets');
    
        // Kolom yang relevan untuk penghitungan Naïve Bayes
        $relevantColumns = [
            'nama',
            'status_pekerjaan',
            'ips_semester_1',
            'ips_semester_2',
            'ips_semester_3',
            'ips_semester_4',
            'sks_semester_1',
            'sks_semester_2',
            'sks_semester_3',
            'sks_semester_4',
            'status_pembayaran',
            'kelulusan',  // Kolom yang berisi kelas (keputusan)
        ];
    
        // Preprocessing: Filter data bersih setelah menghapus baris dengan missing value (nilai 0)
        $cleanedDatasets = $datasets->filter(function ($data) {
            // Memeriksa jika ada kolom yang memiliki nilai 0 atau null, data akan dihilangkan
            return $data->status_pekerjaan !== 0 &&
                   $data->ips_semester_1 !== 0 && $data->ips_semester_2 !== 0 && $data->ips_semester_3 !== 0 && $data->ips_semester_4 !== 0 &&
                   $data->sks_semester_1 !== 0 && $data->sks_semester_2 !== 0 && $data->sks_semester_3 !== 0 && $data->sks_semester_4 !== 0 &&
                   $data->status_pembayaran !== 0 && $data->kelulusan !== 0; // Memastikan nilai 0 dihapus
        });
    
        // Hanya mengambil kolom relevan untuk penghitungan
        $filteredDatasets = $cleanedDatasets->map(function ($data) use ($relevantColumns) {
            return collect($relevantColumns)->mapWithKeys(function ($column) use ($data) {
                return [$column => $data->$column];
            });
        });
    
        // Split data menjadi training dan testing (50-50 split)
        $splitIndex = floor($filteredDatasets->count() / 2);
        $trainingData = $filteredDatasets->take($splitIndex);
        $testingData = $filteredDatasets->slice($splitIndex);
        // dd($cleanedDatasets);
        return view('dataset.index', compact('datasets', 'cleanedDatasets', 'filteredDatasets', 'columns', 'trainingData', 'testingData'));
    }
    
    
    
    public function calculation()
    {
        // Ambil dataset bersih (data yang tidak difilter)
        $cleanedDatasets = Dataset::all()->filter(function ($data) {
            return $data->status_pekerjaan !== 0 &&
                   $data->ips_semester_1 !== 0 &&
                   $data->ips_semester_2 !== 0 &&
                   $data->ips_semester_3 !== 0 &&
                   $data->ips_semester_4 !== 0 &&
                   $data->sks_semester_1 !== 0 &&
                   $data->sks_semester_2 !== 0 &&
                   $data->sks_semester_3 !== 0 &&
                   $data->sks_semester_4 !== 0 &&
                   $data->status_pembayaran !== 0 &&
                   $data->kelulusan !== 0;
        });
    
        if ($cleanedDatasets->count() < 2) {
            return back()->with('error', 'Dataset tidak cukup untuk melakukan pembagian training dan testing.');
        }
    
        // Shuffle dan split data
        $shuffledData = $cleanedDatasets;
        $splitIndex = floor($shuffledData->count() / 2);
        $testingData = $shuffledData->take($splitIndex);
        $trainingData = $shuffledData->slice($splitIndex);
    
        // Hitung probabilitas prior
        $prior = $trainingData->groupBy('kelulusan')->map(function ($group) use ($trainingData) {
            return $group->count() / $trainingData->count();
        });
    
        // Hitung likelihood dengan smoothing
        $attributes = ['status_pekerjaan', 'ips_semester_1', 'ips_semester_2', 'ips_semester_3', 'ips_semester_4', 
                       'sks_semester_1', 'sks_semester_2', 'sks_semester_3', 'sks_semester_4', 'status_pembayaran'];
        $likelihood = $this->computeAttributeLikelihoods($trainingData->groupBy('kelulusan'), $attributes);
    
        // Confusion Matrix
        $confusionMatrix = [
            'Lulus' => ['Lulus' => 0, 'Tidak Lulus' => 0],
            'Tidak Lulus' => ['Lulus' => 0, 'Tidak Lulus' => 0],
        ];
    
        // Ambil data asli dari database (tanpa filter)
        $actualData = Dataset::all();
    
        // Prediksi data testing
        foreach ($testingData as $test) {
            $predictedClass = $this->classifyData($trainingData, $test, $attributes, $prior, $likelihood);
            
            // Ambil kelas aktual dari data asli
            // Menggunakan metode "shift" untuk mengambil data aktual secara berurutan
            $actualClass = $actualData->shift()->kelulusan;
    
            // Update confusion matrix
            if (isset($confusionMatrix[$actualClass][$predictedClass])) {
                $confusionMatrix[$actualClass][$predictedClass]++;
            }
        }
    
        // Evaluasi
        $truePositive = $confusionMatrix['Lulus']['Lulus'] ?? 0;
        $falsePositive = $confusionMatrix['Tidak Lulus']['Lulus'] ?? 0;
        $trueNegative = $confusionMatrix['Tidak Lulus']['Tidak Lulus'] ?? 0;
        $falseNegative = $confusionMatrix['Lulus']['Tidak Lulus'] ?? 0;
    
        $accuracy = ($truePositive + $trueNegative) / max(1, $testingData->count());
        $precision = $truePositive / max(1, $truePositive + $falsePositive);
        $recall = $truePositive / max(1, $truePositive + $falseNegative);
    
        return view('calculation', compact('prior', 'likelihood', 'confusionMatrix', 'accuracy', 'precision', 'recall'));
    }
    
    
    private function computeAttributeLikelihoods($grouped, $attributes)
    {
        return collect($attributes)->mapWithKeys(function ($attribute) use ($grouped) {
            return [
                $attribute => $grouped->map(function ($group) use ($attribute) {
                    // Menghitung probabilitas setiap nilai atribut dalam grup
                    return $group->groupBy($attribute)->map(function ($valueGroup) use ($group) {
                        return $valueGroup->count() / $group->count(); // Probabilitas nilai atribut dalam grup
                    });
                }),
            ];
        });
    }
    
    private function classifyData($trainingData, $test, $attributes, $prior, $likelihood)
    {
        // Menghitung likelihood untuk setiap kelas berdasarkan data uji
        $likelihoods = $prior->map(function ($probability, $class) use ($test, $attributes, $likelihood) {
            // Menghitung produk likelihood untuk setiap atribut dalam data uji
            $likelihoodProduct = collect($attributes)->reduce(function ($carry, $attribute) use ($test, $class, $likelihood) {
                $attributeValue = $test->$attribute; // Ambil nilai atribut dari data uji
    
                // Cek apakah nilai atribut ada dalam data pelatihan untuk kelas ini
                $attributeLikelihood = $likelihood[$attribute][$class][$attributeValue] ?? 1e-6; // Gunakan smoothing jika tidak ada
    
                return $carry * $attributeLikelihood; // Mengalikan dengan carry (produk dari likelihood sebelumnya)
            }, 1); // Mulai dengan 1 karena kita mengalikan semua nilai likelihood
    
            return $probability * $likelihoodProduct; // Kembalikan prior * produk likelihood
        });
    
        // Mengurutkan berdasarkan probabilitas tertinggi untuk menentukan kelas yang diprediksi
        return $likelihoods->sortDesc()->keys()->first();
    }
    
// Contoh di Controller


    
    private function calculateAttributeProbabilities($grouped, $attributes)
    {
        return collect($attributes)->mapWithKeys(function ($parameters, $attribute) use ($grouped) {
            return [
                $attribute => collect($parameters)->mapWithKeys(function ($parameter) use ($grouped, $attribute) {
                    $probabilities = $grouped->map(function ($group, $kelas) use ($attribute, $parameter) {
                        // Cek jika parameter adalah "Mean" untuk SKS atau Matkul
                        if ($parameter === 'Mean' && in_array($attribute, ['total_sks_lulus', 'total_matkul_lulus'])) {
                            // Hitung rata-rata (mean) untuk atribut tersebut pada setiap kelas
                            $meanValue = $group->pluck($attribute)->avg(); // Menghitung rata-rata
    
                            // Probabilitas berdasarkan mean, jika nilai lebih besar dari rata-rata
                            $probability = $group->where($attribute, '>=', $meanValue)->count() / $group->count();
                            return $probability;
                        }
    
                        // Jika bukan parameter Mean, gunakan Laplace smoothing
                        $total = $group->count(); // Total data dalam kelas
                        $countParameter = $group->where($attribute, $parameter)->count(); // Jumlah data dengan parameter tertentu
    
                        // Laplace smoothing untuk parameter lain
                        $smoothedProbability = ($countParameter + 0.00004) / ($total + 0.0000005);
    
                        return $smoothedProbability;
                    });
    
                    return [
                        $parameter => [
                            'Lulus' => $probabilities->get('Lulus', 0),
                            'Tidak Lulus' => $probabilities->get('Tidak Lulus', 0),
                        ],
                    ];
                }),
            ];
        });
    } 


private function predictClass($trainingData, $test, $attributes)
{
    $likelihoods = $trainingData->groupBy('kelulusan')->mapWithKeys(function ($group, $class) use ($test, $attributes) {
        $likelihood = collect($attributes)->reduce(function ($carry, $attribute) use ($group, $test) {
            $filtered = $group->where($attribute, $test->$attribute);
            return $carry * (($filtered->count() + 1) / ($group->count() + 2)); // Laplace smoothing
        }, 1);

        return [$class => $likelihood];
    });

    return $likelihoods->sortDesc()->keys()->first();
}


public function evaluation()
{
    // Ambil semua data dari tabel datasets
    $datasets = Dataset::all();

    // Mendapatkan semua kolom dari tabel datasets
    $columns = DB::getSchemaBuilder()->getColumnListing('datasets');

    // Kolom yang relevan untuk penghitungan Naïve Bayes
    $relevantColumns = [
        'nama',
        'status_pekerjaan',
        'ips_semester_1',
        'ips_semester_2',
        'ips_semester_3',
        'ips_semester_4',
        'sks_semester_1',
        'sks_semester_2',
        'sks_semester_3',
        'sks_semester_4',
        'status_pembayaran',
        'kelulusan',  // Kolom yang berisi kelas (keputusan)
    ];

    // Preprocessing: Filter data bersih setelah menghapus baris dengan missing value (nilai 0)
    $cleanedDatasets = $datasets->filter(function ($data) {
        // Memeriksa jika ada kolom yang memiliki nilai 0 atau null, data akan dihilangkan
        return $data->status_pekerjaan !== 0 &&
               $data->ips_semester_1 !== 0 && $data->ips_semester_2 !== 0 && $data->ips_semester_3 !== 0 && $data->ips_semester_4 !== 0 &&
               $data->sks_semester_1 !== 0 && $data->sks_semester_2 !== 0 && $data->sks_semester_3 !== 0 && $data->sks_semester_4 !== 0 &&
               $data->status_pembayaran !== 0 && $data->kelulusan !== 0; // Memastikan nilai 0 dihapus
    });

    // Hanya mengambil kolom relevan untuk penghitungan
    $filteredDatasets = $cleanedDatasets->map(function ($data) use ($relevantColumns) {
        return collect($relevantColumns)->mapWithKeys(function ($column) use ($data) {
            return [$column => $data->$column];
        });
    });

    // Split data menjadi training dan testing (50-50 split)
    $splitIndex = floor($filteredDatasets->count() / 2);
    $testingData = $filteredDatasets->take($splitIndex);
    $trainingData = $filteredDatasets->slice($splitIndex);
    // $testingData = $filteredDatasets->slice($splitIndex);
    // dd($cleanedDatasets);
    return view('evaluation', compact('datasets', 'cleanedDatasets', 'filteredDatasets', 'columns', 'trainingData', 'testingData'));
}

public function probabilities()
{
    // Ambil semua dataset
    $datasets = Dataset::all();

    // Ambil data berdasarkan kelulusan
    $lulus = $datasets->where('kelulusan', 'Lulus');
    $tidakLulus = $datasets->where('kelulusan', 'Tidak Lulus');

    // Hitung total data untuk lulus dan tidak lulus
    $totalLulus = $lulus->count();
    $totalTidakLulus = $tidakLulus->count();

    // Probabilitas berdasarkan kategori pekerjaan
    $probabilities = [
        'Status Pekerjaan' => [
            'Bekerja' => [
                'Lulus' => $lulus->where('status_pekerjaan', 'Bekerja')->count(),
                'Tidak Lulus' => $tidakLulus->where('status_pekerjaan', 'Bekerja')->count(),
            ],
            'Tidak Bekerja' => [
                'Lulus' => $lulus->where('status_pekerjaan', 'Tidak Bekerja')->count(),
                'Tidak Lulus' => $tidakLulus->where('status_pekerjaan', 'Tidak Bekerja')->count(),
            ]
        ]
    ];

    // Kategorikan IPK dan hitung probabilitasnya
    $categories = ['Sangat Memuaskan', 'Memuaskan', 'Kurang', 'Cukup'];

    $probabilities['IPK'] = [];
    foreach ($categories as $category) {
        $probabilities['IPK'][$category] = [
            'Lulus' => $lulus->filter(function ($data) use ($category) {
                return $this->categorizeIPK($data) === $category;
            })->count(),
            'Tidak Lulus' => $tidakLulus->filter(function ($data) use ($category) {
                return $this->categorizeIPK($data) === $category;
            })->count(),
        ];
    }

    // Ambil semua data SKS untuk lulus dan tidak lulus (mengabaikan semester)
    $lulusSks = $lulus->pluck('sks_semester_1', 'sks_semester_2', 'sks_semester_3', 'sks_semester_4')->flatten()->filter()->values();
    $tidakLulusSks = $tidakLulus->pluck('sks_semester_1', 'sks_semester_2', 'sks_semester_3', 'sks_semester_4')->flatten()->filter()->values();
    $allSks = $datasets->pluck('sks_semester_1', 'sks_semester_2', 'sks_semester_3', 'sks_semester_4')->flatten()->filter()->values(); // Seluruh dataset

    // Hitung jumlah dan mean serta stddev untuk Lulus, Tidak Lulus, dan Semua Data
    $sksProbabilities = [
        // Mean untuk Lulus
        'meanYaPembilang' => $lulusSks->count(),
        'meanYaPenyebut' => $lulus->count(),
        'meanYaHasil' => $lulusSks->count() / $lulus->count(),
        
        // Mean untuk Tidak Lulus
        'meanTidakPembilang' => $tidakLulusSks->count(),
        'meanTidakPenyebut' => $tidakLulus->count(),
        'meanTidakHasil' => $tidakLulusSks->count() / $tidakLulus->count(),
        
        // Mean untuk Semua Data
        'meanTotalPembilang' => $allSks->count(),
        'meanTotalPenyebut' => $datasets->count(),
        'meanTotalHasil' => $allSks->count() / $datasets->count(),
        
        // StdDev untuk Lulus
        'stddevYaPembilang' => $lulusSks->count(),
        'stddevYaPenyebut' => $lulus->count(),
        'stddevYaHasil' => $this->calculateStdDev($lulusSks),
        
        // StdDev untuk Tidak Lulus
        'stddevTidakPembilang' => $tidakLulusSks->count(),
        'stddevTidakPenyebut' => $tidakLulus->count(),
        'stddevTidakHasil' => $this->calculateStdDev($tidakLulusSks),
        
        // StdDev untuk Semua Data
        'stddevTotalPembilang' => $allSks->count(),
        'stddevTotalPenyebut' => $datasets->count(),
        'stddevTotalHasil' => $this->calculateStdDev($allSks),
    ];

    // Kembalikan data ke view
    return view('probabilities', compact('probabilities', 'totalLulus', 'totalTidakLulus', 'sksProbabilities'));
}


// Fungsi untuk mengkategorikan IPK
private function categorizeIPK($data)
{
    $averageIPK = collect([
        $data->ips_semester_1,
        $data->ips_semester_2,
        $data->ips_semester_3,
        $data->ips_semester_4,
    ])->filter()->average(); // Hitung rata-rata, abaikan nilai null

    if ($averageIPK >= 3.5) {
        return 'Sangat Memuaskan';
    } elseif ($averageIPK >= 3.0) {
        return 'Memuaskan';
    } elseif ($averageIPK >= 2.5) {
        return 'Cukup';
    } else {
        return 'Kurang';
    }
}

// Fungsi untuk menghitung standard deviation
private function calculateStdDev(Collection $values)
{
    $count = $values->count();
    if ($count == 0) {
        return 0;
    }

    $mean = $values->average();
    $variance = $values->map(function ($value) use ($mean) {
        return pow(($value - $mean), 2);
    })->sum() / $count;

    return sqrt($variance);
}



}
