const images = document.querySelectorAll('.carousel img');
const bottons = document.querySelectorAll('.carousel-bottons span');
let currentIndex = 0;
const intervalTime = 10000; // 10 seconds
let interval;

function updateCarousel() {
    images.forEach((img, index) => {
        img.classList.remove('active', 'prev', 'next');
        bottons[index].classList.remove('active');
        if (index === currentIndex) {
            img.classList.add('active');
            bottons[index].classList.add('active');
        } else if (index === (currentIndex - 1 + images.length) % images.length) {
            img.classList.add('prev');
        } else if (index === (currentIndex + 1) % images.length) {
            img.classList.add('next');
        }
    });
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    updateCarousel();
}

function goToImage(index) {
    currentIndex = index;
    updateCarousel();
    resetInterval(); // Reiniciar el intervalo automático
}

function resetInterval() {
    clearInterval(interval);
    interval = setInterval(nextImage, intervalTime);
}

// Añadir evento de clic a los puntos
bottons.forEach((dot, index) => {
    dot.addEventListener('click', () => goToImage(index));
});

// Iniciar el carrusel automático
interval = setInterval(nextImage, intervalTime);

updateCarousel();