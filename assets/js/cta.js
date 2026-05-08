// ============================================
// CTA FLOTANTE INFERIOR - APARECE DESPUÉS DEL HERO
// ============================================

(function() {
    'use strict';
    
    // Configuración
    const CTA_STORAGE_KEY = 'floatingCTAClosed';
    const CTA_REAPPEAR_TIME = 2 * 60 * 1000; // 2 minutos en milisegundos
    
    let ctaTimeout = null;
    let scrollTimeout = null;
    
    // ============================================
    // 1. FUNCIONES PRINCIPALES
    // ============================================
    
    function showFloatingCTA() {
        const cta = document.getElementById('floatingCTA');
        if (cta && !cta.classList.contains('show')) {
            cta.classList.add('show');
        }
    }
    
    function hideFloatingCTA() {
        const cta = document.getElementById('floatingCTA');
        if (cta && cta.classList.contains('show')) {
            cta.classList.remove('show');
        }
    }
    
    // ============================================
    // 2. VERIFICAR SI EL USUARIO CERRÓ EL CTA RECIENTEMENTE
    // ============================================
    
    function isCTARecentlyClosed() {
        const closedTime = sessionStorage.getItem(CTA_STORAGE_KEY);
        if (!closedTime) return false;
        
        const timePassed = Date.now() - parseInt(closedTime);
        return timePassed < CTA_REAPPEAR_TIME;
    }
    
    function markCTAAsClosed() {
        sessionStorage.setItem(CTA_STORAGE_KEY, Date.now().toString());
        hideFloatingCTA();
    }
    
    // ============================================
    // 3. REAPARECER DESPUÉS DE 2 MINUTOS
    // ============================================
    
    function scheduleCTAReappear() {
        if (ctaTimeout) clearTimeout(ctaTimeout);
        
        ctaTimeout = setTimeout(() => {
            // Verificar nuevamente si sigue cerrada la sesión
            if (isCTARecentlyClosed()) {
                // Si aún no ha pasado el tiempo, volver a programar
                const closedTime = parseInt(sessionStorage.getItem(CTA_STORAGE_KEY));
                const timePassed = Date.now() - closedTime;
                const remainingTime = CTA_REAPPEAR_TIME - timePassed;
                
                if (remainingTime > 0) {
                    ctaTimeout = setTimeout(() => {
                        sessionStorage.removeItem(CTA_STORAGE_KEY);
                        showFloatingCTA();
                    }, remainingTime);
                }
            } else {
                // Borrar la marca y mostrar
                sessionStorage.removeItem(CTA_STORAGE_KEY);
                showFloatingCTA();
            }
        }, CTA_REAPPEAR_TIME);
    }
    
    // ============================================
    // 4. FUNCIÓN PARA CERRAR MANUALMENTE
    // ============================================
    
    window.closeFloatingCTA = function() {
        markCTAAsClosed();
        scheduleCTAReappear();
    };
    
    // ============================================
    // 5. APARECER DESPUÉS DE PASAR EL HERO
    // ============================================
    
    function checkHeroVisibility() {
        const hero = document.getElementById('home');
        if (!hero) return;
        
        const heroBottom = hero.getBoundingClientRect().bottom;
        const viewportHeight = window.innerHeight;
        
        // Si el usuario ya pasó el hero (scroll más allá del hero)
        if (heroBottom < viewportHeight / 2) {
            // Si no está cerrada recientemente, mostrar
            if (!isCTARecentlyClosed()) {
                showFloatingCTA();
            }
            // Dejar de observar
            if (heroObserver) heroObserver.disconnect();
        }
    }
    
    // Observer para detectar cuando se pasa el hero
    let heroObserver = null;
    
    function initHeroObserver() {
        const hero = document.getElementById('home');
        if (!hero) {
            console.warn('⚠️ No se encontró la sección #home');
            return;
        }
        
        heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Cuando el hero ya no es visible (salió de la pantalla)
                if (!entry.isIntersecting && entry.boundingClientRect.bottom < 0) {
                    if (!isCTARecentlyClosed()) {
                        showFloatingCTA();
                    }
                    heroObserver.disconnect();
                }
            });
        }, { threshold: 0 });
        
        heroObserver.observe(hero);
    }
    
    // ============================================
    // 6. SCROLL TO TOUR (función auxiliar)
    // ============================================
    
    window.scrollToTour = function() {
        const tourSection = document.getElementById('tour');
        if (tourSection) {
            const offsetTop = tourSection.offsetTop - 80;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        } else {
            // Si no existe #tour, ir a #beneficios
            const beneficiosSection = document.getElementById('beneficios');
            if (beneficiosSection) {
                beneficiosSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
        // Opcional: cerrar CTA después de hacer scroll
        // closeFloatingCTA();
    };
    
    // ============================================
    // 7. INICIALIZACIÓN
    // ============================================
    
    function init() {
        // Limpiar cualquier timeout previo
        if (ctaTimeout) clearTimeout(ctaTimeout);
        
        // Asegurar que el CTA comienza oculto
        hideFloatingCTA();
        
        // Iniciar observador del hero
        initHeroObserver();
        
        // Verificar si ya se pasó el hero (si la página carga ya scrolleada)
        setTimeout(() => {
            const hero = document.getElementById('home');
            if (hero) {
                const heroBottom = hero.getBoundingClientRect().bottom;
                if (heroBottom < 50) {
                    if (!isCTARecentlyClosed()) {
                        showFloatingCTA();
                    }
                    if (heroObserver) heroObserver.disconnect();
                }
            }
        }, 500);
        
    }
    
    // Ejecutar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
})();