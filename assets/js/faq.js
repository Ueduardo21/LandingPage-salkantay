// ============================================
// FAQ - ACORDEÓN + STICKY SIDEBAR
// ============================================

(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        
        
        // ============================================
        // 1. ACORDEÓN DE PREGUNTAS
        // ============================================
        
        const accordionItems = document.querySelectorAll('.accordion-item');
        
        if (accordionItems.length > 0) {
            accordionItems.forEach(item => {
                const question = item.querySelector('.accordion-question');
                
                if (question) {
                    question.addEventListener('click', function() {
                        // Cerrar otros items (solo uno abierto a la vez)
                        accordionItems.forEach(otherItem => {
                            if (otherItem !== item && otherItem.classList.contains('active')) {
                                otherItem.classList.remove('active');
                            }
                        });
                        // Toggle el actual
                        item.classList.toggle('active');
                    });
                }
            });
        }
        
        // ============================================
        // 2. STICKY SIDEBAR (ya funciona con CSS)
        // Solo verificamos que exista
        // ============================================
        
        const sidebar = document.querySelector('.faq-sidebar');
        if (sidebar) {
        }
        
        // ============================================
        // 3. ANIMACIÓN AL HOVER DE ESTADÍSTICAS
        // ============================================
        
        const statItems = document.querySelectorAll('.stat-item');
        statItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                const icon = item.querySelector('i');
                if (icon) {
                    icon.style.transform = 'scale(1.1)';
                    icon.style.transition = 'transform 0.3s ease';
                }
            });
            item.addEventListener('mouseleave', () => {
                const icon = item.querySelector('i');
                if (icon) {
                    icon.style.transform = 'scale(1)';
                }
            });
        });
        
        // ============================================
        // 4. VERIFICAR VISIBILIDAD DE LA SECCIÓN
        // ============================================
        
        const faqSection = document.querySelector('.faq-section');
        if (faqSection) {
            const rect = faqSection.getBoundingClientRect();
        }
        
    });
    
})();