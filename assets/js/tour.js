// ============================================
<<<<<<< HEAD
// SIDEBAR TOUR - CON STICKY
=======
// SIDEBAR TOUR - JAVASCRIPT (VERSIÓN SIMPLIFICADA)
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
<<<<<<< HEAD
=======
    // ANIMACIONES DEL SIDEBAR AL SCROLL
    // ============================================
    
    const sidebar = document.querySelector('.tour-sidebar');
    const sidebarCard = document.querySelector('.sidebar-card');
    
    if (sidebar && sidebarCard) {
        window.addEventListener('scroll', () => {
            const scrollPosition = window.scrollY;
            const sidebarTop = sidebar.offsetTop;
            
            if (scrollPosition > sidebarTop - 20) {
                sidebarCard.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
            } else {
                sidebarCard.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
            }
        });
    }
    
    // ============================================
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
    // REVELACIÓN DE ELEMENTOS AL SCROLL
    // ============================================
    
    const revealElements = document.querySelectorAll('.experience-card, .includes-card, .excludes-card, .itinerario-card, .sidebar-card');
    
    if (revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        revealElements.forEach(el => {
            el.classList.add('reveal-hidden');
            revealObserver.observe(el);
        });
    }
    
<<<<<<< HEAD
    // ============================================
    // SOMBRA DINÁMICA AL HACER SCROLL
    // ============================================
    
    const sidebarCard = document.querySelector('.sidebar-card');
    
    if (sidebarCard) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                sidebarCard.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
            } else {
                sidebarCard.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.1)';
            }
        });
    }
    
=======
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
});

// ============================================
// CSS PARA LAS ANIMACIONES
// ============================================

(function addAnimationStyles() {
    if (document.getElementById('tour-animation-styles')) return;
    
    const animationStyle = document.createElement('style');
    animationStyle.id = 'tour-animation-styles';
    animationStyle.textContent = `
        .reveal-hidden {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .revealed {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        
        @media (prefers-reduced-motion: reduce) {
            .reveal-hidden {
                opacity: 1;
                transform: none;
            }
        }
    `;
    document.head.appendChild(animationStyle);
})();