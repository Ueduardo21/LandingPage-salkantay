// Manejo optimizado de video de fondo
document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector('.hero-video');
    
    if (video) {
        // Detectar si es dispositivo móvil
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        
        if (isMobile) {
            // En móviles, pausar el video para ahorrar recursos
            video.pause();
            video.style.display = 'none';
        } else {
            // En desktop, asegurar que el video se reproduzca
            video.play().catch(function(error) {
                console.log("Autoplay prevented:", error);
                // Si no puede reproducir automáticamente, mostrar overlay solamente
                video.style.opacity = '0.5';
            });
        }
        
        // Pausar video cuando no está visible (ahorra recursos)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        });
        
        observer.observe(video);
    }
});