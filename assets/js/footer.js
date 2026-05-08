// ============================================
// FOOTER - ANIMACIONES AL SCROLL
// ============================================

(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // ============================================
        // 1. ACTUALIZAR AÑO ACTUAL
        // ============================================
        
        const yearSpan = document.getElementById('currentYear');
        if (yearSpan) {
            yearSpan.textContent = new Date().getFullYear();
        }
        
        // ============================================
        // 2. ANIMACIÓN DE ENTRADA AL SCROLL
        // ============================================
        
        const footerCols = document.querySelectorAll('.footer-col');
        
        if (footerCols.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });
            
            footerCols.forEach(col => {
                observer.observe(col);
            });
        }
        
        // ============================================
        // 3. SCROLL SUAVE PARA ENLACES DEL FOOTER
        // ============================================
        
        const footerLinks = document.querySelectorAll('.footer-logo, .footer a[href^="#"]');
        
        footerLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href !== '#' && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offsetTop = target.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
        
    });
    
})();