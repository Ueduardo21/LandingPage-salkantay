// ============================================
// BENEFICIOS - ANIMACIONES
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. REVELACIÓN AL HACER SCROLL
    // ============================================
    
    const beneficiosObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                beneficiosObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    
    document.querySelectorAll('.beneficio-card, .adicional-item').forEach(el => {
        beneficiosObserver.observe(el);
    });
    
    // ============================================
    // 2. EFECTO DE CONTADOR EN BADGES (OPCIONAL)
    // ============================================
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const badge = entry.target;
                const text = badge.innerText;
                if (text.includes('Máx')) {
                    badge.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        badge.style.transform = 'scale(1)';
                    }, 300);
                }
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.beneficio-badge').forEach(badge => {
        statsObserver.observe(badge);
    });
    
    // ============================================
    // 3. EFECTO HOVER EN TABLA
    // ============================================
    
    const tableRows = document.querySelectorAll('.comparison-grid tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.backgroundColor = '#f8f9fa';
            row.style.transition = 'all 0.3s ease';
        });
        row.addEventListener('mouseleave', () => {
            row.style.backgroundColor = 'transparent';
        });
    });
    
});