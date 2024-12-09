// resources/js/app.js

window.addEventListener('scroll', function() {
    const nav = document.querySelector('nav');
    
    // Menambahkan efek pada navbar saat scroll
    if (window.scrollY > 50) {
        nav.style.transform = 'translateY(-10px)';  // Menggeser navbar sedikit ke atas
        nav.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.3)';  // Bayangan lebih tajam saat scroll
    } else {
        nav.style.transform = 'translateY(0)';  // Mengembalikan navbar ke posisi awal
        nav.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.2)';  // Bayangan normal
    }
});
