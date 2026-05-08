// ============================================
// FOOTER - AÑO ACTUAL
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Año actual
    const yearElement = document.getElementById('currentYear');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
    
});