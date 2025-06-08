document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.sidebar');
    const hamburgerIcon = document.querySelector('.hamburger-icon');

    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        hamburgerIcon.classList.toggle('active');
    });

    // Animasi hamburger icon
    hamburger.addEventListener('click', function() {
        const spans = hamburgerIcon.querySelectorAll('span');
        spans[0].style.transform = sidebar.classList.contains('active') ? 'rotate(45deg) translate(5px, 5px)' : 'none';
        spans[1].style.opacity = sidebar.classList.contains('active') ? '0' : '1';
        spans[2].style.transform = sidebar.classList.contains('active') ? 'rotate(-45deg) translate(7px, -7px)' : 'none';
    });

    // Menutup sidebar saat mengklik di luar sidebar
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            const spans = hamburgerIcon.querySelectorAll('span');
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    });
}); 