// JavaScript untuk mengatur animasi berdasarkan gerakan mouse
let bottomBar = document.getElementById('bottomBar');
let timeout;

document.addEventListener('mousemove', function() {
    clearTimeout(timeout);
    bottomBar.classList.add('active');
    bottomBar.classList.remove('inactive');

    // Timeout untuk menghilangkan bottom bar setelah beberapa detik
    timeout = setTimeout(function() {
        bottomBar.classList.remove('active');
        bottomBar.classList.add('inactive');
    }, 3000); // 3 detik setelah mouse tidak bergerak
});
