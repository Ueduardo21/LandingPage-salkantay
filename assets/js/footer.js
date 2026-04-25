// ============================================
// FOOTER - JAVASCRIPT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Actualizar año automático en copyright
    const yearSpan = document.querySelector('.footer-bottom p');
    if (yearSpan) {
        const currentYear = new Date().getFullYear();
        yearSpan.innerHTML = yearSpan.innerHTML.replace('2024', currentYear);
    }
    
    // 2. Función para seleccionar tour desde footer
    window.selectTour = function(tourId) {
        // Cambiar a la sección de tours
        const tourSection = document.getElementById('tour');
        if (tourSection) {
            tourSection.scrollIntoView({ behavior: 'smooth' });
        }
        
        // Cambiar el selector de tours
        setTimeout(() => {
            const tourBtns = document.querySelectorAll('.tour-btn');
            const tourContents = document.querySelectorAll('.tour-content');
            
            tourBtns.forEach(btn => {
                if (btn.getAttribute('data-tour') === tourId) {
                    btn.click();
                }
            });
        }, 500);
    };
    
    // 3. Animación de hover en redes sociales
    const socialLinks = document.querySelectorAll('.footer-social a');
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});