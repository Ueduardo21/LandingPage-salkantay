// ============================================
// FAQ - ACORDEÓN Y ANIMACIONES
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. ACORDEÓN DE PREGUNTAS
    // ============================================
    
    const accordionItems = document.querySelectorAll('.accordion-item');
    
    accordionItems.forEach(item => {
        const question = item.querySelector('.accordion-question');
        
        question.addEventListener('click', () => {
            // Cerrar otros items (opcional - comentar si se quiere múltiple abierto)
            accordionItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle el actual
            item.classList.toggle('active');
        });
    });
    
    // Opcional: Abrir la primera pregunta por defecto
    if (accordionItems.length > 0) {
        // accordionItems[0].classList.add('active'); // Descomentar si se desea abrir por defecto
    }
    
    // ============================================
    // 2. BÚSQUEDA EN FAQ (OPCIONAL)
    // ============================================
    
    function searchFAQs(searchTerm) {
        const allQuestions = document.querySelectorAll('.accordion-question span');
        const accordionItems = document.querySelectorAll('.accordion-item');
        
        if (!searchTerm || searchTerm.length < 2) {
            // Mostrar todas
            accordionItems.forEach(item => {
                item.style.display = '';
            });
            return;
        }
        
        const term = searchTerm.toLowerCase();
        
        accordionItems.forEach(item => {
            const questionText = item.querySelector('.accordion-question span').innerText.toLowerCase();
            const answerText = item.querySelector('.accordion-answer')?.innerText.toLowerCase() || '';
            
            if (questionText.includes(term) || answerText.includes(term)) {
                item.style.display = '';
                // Abrir los que coinciden
                item.classList.add('active');
            } else {
                item.style.display = 'none';
                item.classList.remove('active');
            }
        });
    }
    
    // ============================================
    // 3. ANIMACIONES AL SCROLL
    // ============================================
    
    const faqElements = document.querySelectorAll('.faq-sidebar, .faq-accordion, .faq-footer');
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    faqElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        scrollObserver.observe(el);
    });
    
    // ============================================
    // 4. ESTADÍSTICAS CON CONTADOR
    // ============================================
    
    function animateStats() {
        const statNumbers = document.querySelectorAll('.faq-stats .stat-number');
        
        statNumbers.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-target'));
            if (!target) return;
            
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    stat.innerText = target;
                    clearInterval(timer);
                } else {
                    stat.innerText = Math.floor(current);
                }
            }, 30);
        });
    }
    
    // Observar estadísticas
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateStats();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const statsContainer = document.querySelector('.faq-stats');
    if (statsContainer) {
        statsObserver.observe(statsContainer);
    }
    
});