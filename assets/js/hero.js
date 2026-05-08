/* ============================================
     HERO.JS - VIDEO RESPONSIVE (CORREGIDO)
     ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector('.hero-video');
    
    if (!video) return;
    
    // Detectar dispositivo móvil
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    // IMPORTANTE: Asegurar que el video tenga muted
    video.muted = true;
    video.playsInline = true;  // Para iOS
    
    if (isMobile) {
        // En móviles: NO ocultar, solo asegurar reproducción
        video.style.display = 'block';  // ← NO lo ocultes
        video.style.opacity = '0.95';
        
        // Intentar reproducir
        video.play().then(() => {
            console.log('Video reproduciéndose en móvil');
        }).catch((error) => {
            console.log('Error en móvil:', error);
            // Si falla, mostrar mensaje o imagen de respaldo
            video.style.opacity = '0.5';
        });
    } else {
        // En desktop
        video.play().catch((error) => {
            console.log('Autoplay bloqueado en desktop:', error);
        });
    }
    
    // Pausar video cuando no está visible (ahorra recursos)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                video.play().catch(e => console.log('Play prevented:', e));
            } else {
                video.pause();
            }
        });
    });
    
    observer.observe(video);
    
    // Reanudar cuando la página vuelve a ser visible
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden && video.paused) {
            video.play().catch(e => console.log('Play on visibility change:', e));
        }
    });
});