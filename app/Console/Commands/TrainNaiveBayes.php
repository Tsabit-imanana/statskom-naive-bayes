<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Phpml\Classification\NaiveBayes;
use Phpml\ModelManager;
use Phpml\Dataset\CsvDataset;

class TrainNaiveBayes extends Command
{
    protected $signature = 'naivebayes:train';
    protected $description = 'Train the Naive Bayes model using the dataset';

    public function handle()
    {
        $filePath = database_path('data/mahasiswa.csv');  
        $delimiter = ';'; // Tambahkan delimiter untuk dataset Anda
        $dataset = new CsvDataset($filePath, 10, true, $delimiter); // Kolom target ada di indeks ke-10
        $samples = $dataset->getSamples();
        $labels = $dataset->getTargets();

        $classifier = new NaiveBayes();
        $classifier->train($samples, $labels);

        // Simpan model ke file
        $modelManager = new ModelManager();
        $modelManager->saveToFile($classifier, storage_path('app/naive_bayes_model.model'));

        $this->info('Model berhasil dilatih dan disimpan!');
    }
}
