// ============================================
// BENEFICIOS - ANIMACIONES (CORREGIDO)
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    
    // ============================================
    // 1. REVELACIÓN AL HACER SCROLL (OPCIONAL)
    // ============================================
    
    const beneficiosObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                // No dejar de observar para mantener la clase
            }
        });
    }, { threshold: 0.1 });
    
    // Observar elementos de beneficios
    const elementsToObserve = document.querySelectorAll('.beneficio-card, .extra-item, .comparison-table, .beneficios-cta');
    
    if (elementsToObserve.length > 0) {
        elementsToObserve.forEach(el => {
            beneficiosObserver.observe(el);
            // Asegurar que sean visibles desde el inicio
            el.style.opacity = '1';
            el.style.visibility = 'visible';
        });
    } else {
        console.warn('⚠️ No se encontraron elementos para observar en beneficios');
    }
    
    // ============================================
    // 2. EFECTO HOVER EN TABLA
    // ============================================
    
    const tableRows = document.querySelectorAll('.comparison-grid tbody tr');
    if (tableRows.length > 0) {
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.backgroundColor = '#f8f9fa';
                row.style.transition = 'all 0.3s ease';
            });
            row.addEventListener('mouseleave', () => {
                row.style.backgroundColor = 'transparent';
            });
        });
    }
    
    // ============================================
    // 3. VERIFICAR VISIBILIDAD DE LA SECCIÓN
    // ============================================
    
    const beneficiosSection = document.querySelector('.beneficios-section');
    if (beneficiosSection) {
        const rect = beneficiosSection.getBoundingClientRect();
    } else {
    }
    
});