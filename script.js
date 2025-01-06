document.addEventListener('DOMContentLoaded', () => {
    const navbarNav = document.querySelector('.navbar-nav');
    const hamburger = document.querySelector('#hamburger-menu');

    // Pastikan elemen ditemukan sebelum menambahkan logika
    if (navbarNav && hamburger) {
        hamburger.onclick = () => {
            navbarNav.classList.toggle('active');
        };

        document.addEventListener('click', function (e) {
            if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
                navbarNav.classList.remove('active');
            }
        });
    } else {
        console.warn("Elemen '.navbar-nav' atau '#hamburger-menu' tidak ditemukan di halaman ini.");
    }
});

// Fungsi untuk membuka modal
 function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Menutup modal ketika pengguna mengklik di luar modal
window.onclick = function(event) {
    const modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
            modals[i].style.display = "none";
        }
    }
}

// Misalnya Anda dapat mengecek status login dengan menggunakan session atau local storage
if (userLoggedIn) {  // userLoggedIn bisa berupa session atau variabel yang menyatakan status login
    document.querySelector('.logout-button').style.display = 'block';
    document.querySelector('.login').style.display = 'none';
} else {
    document.querySelector('.logout-button').style.display = 'none';
    document.querySelector('.login').style.display = 'block';
}

