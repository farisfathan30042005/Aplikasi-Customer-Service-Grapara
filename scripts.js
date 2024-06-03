let currentIndex = 0;

function showSlide(index) {
    const slides = document.querySelector('.carousel-slide');
    const totalSlides = document.querySelectorAll('.carousel-text').length;
    if (index >= totalSlides) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = totalSlides - 1;
    } else {
        currentIndex = index;
    }
    const newTransform = -currentIndex * 100;
    slides.style.transform = `translateX(${newTransform}%)`;
}

setInterval(() => {
    showSlide(currentIndex + 1);
}, 3000);

document.getElementById('admin').addEventListener('click', () => alert('Admin button clicked'));
document.getElementById('customer').addEventListener('click', () => alert('Customer button clicked'));
document.getElementById('customer-service').addEventListener('click', () => alert('Customer Service button clicked'));
document.getElementById('manager').addEventListener('click', () => alert('Manager button clicked'));

function showLoginPopup() {
    document.getElementById('loginPopup').style.display = 'block';
}

function closeLoginPopup() {
    document.getElementById('loginPopup').style.display = 'none';
}

function authenticateAndRedirect() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

  
    if (username && password) {
        if (username === 'admin') {
            window.location.href = 'admin.html';
        } else if (username === 'manager') {
            window.location.href = 'manager.html';
        }
    } else {
        alert("Invalid username or password");
    }
}
