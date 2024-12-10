document.addEventListener('DOMContentLoaded', () => {
    const bottomBar = document.getElementById('bottomBar');
    if (!bottomBar) return; // Pastikan elemen bottomBar ada di DOM

    const icons = {
        home: document.getElementById('homeIcon'),
        dataset: document.getElementById('datasetIcon'),
        evaluation: document.getElementById('evaluationIcon'),
        probabilities: document.getElementById('probabilitiesIcon'),
        accuracy: document.getElementById('accuracyIcon'),
        validation: document.getElementById('validationIcon'),
    };

    const activeSources = {
        home: "{{ asset('images/logo-home-active.svg') }}",
        dataset: "{{ asset('images/logo-dataset-active.svg') }}",
        evaluation: "{{ asset('images/logo-evaluation-active.svg') }}",
        probabilities: "{{ asset('images/logo-probabilities-active.svg') }}",
        accuracy: "{{ asset('images/logo-accuracy-active.svg') }}",
        validation: "{{ asset('images/logo-validation-active.svg') }}",
    };

    const inactiveSources = {
        home: "{{ asset('images/logo-home-inactive.svg') }}",
        dataset: "{{ asset('images/logo-dataset-inactive.svg') }}",
        evaluation: "{{ asset('images/logo-evaluation-inactive.svg') }}",
        probabilities: "{{ asset('images/logo-probabilities-inactive.svg') }}",
        accuracy: "{{ asset('images/logo-accuracy-inactive.svg') }}",
        validation: "{{ asset('images/logo-validation-inactive.svg') }}",
    };

    let timeout;

    // Fungsi untuk mengubah ikon
    const updateIcons = (isActive) => {
        Object.keys(icons).forEach((key) => {
            icons[key].src = isActive ? activeSources[key] : inactiveSources[key];
        });
    };

    // Fungsi untuk mengatur status bottom bar
    const showBottomBar = () => {
        clearTimeout(timeout);
        bottomBar.classList.add('active');
        bottomBar.classList.remove('inactive');
        updateIcons(true);

        // Sembunyikan setelah 3 detik tidak ada gerakan mouse
        timeout = setTimeout(() => {
            bottomBar.classList.remove('active');
            bottomBar.classList.add('inactive');
            updateIcons(false);
        }, 3000);
    };

    // Event untuk menunjukkan bottom bar saat mouse bergerak
    document.addEventListener('mousemove', showBottomBar);

    // Event tambahan untuk mengganti status secara manual (jika diperlukan)
    bottomBar.addEventListener('click', () => {
        if (bottomBar.classList.contains('inactive')) {
            bottomBar.classList.remove('inactive');
            bottomBar.classList.add('active');
            updateIcons(true);
        } else {
            bottomBar.classList.remove('active');
            bottomBar.classList.add('inactive');
            updateIcons(false);
        }
    });

    // Set awal status ikon berdasarkan kelas bottom bar
    updateIcons(bottomBar.classList.contains('active'));
});
