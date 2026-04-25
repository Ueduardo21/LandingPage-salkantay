// ============================================
// CTA FLOTANTE INFERIOR - ACTUALIZADO
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    const floatingCTA = document.getElementById('floatingCTA');
    let isVisible = false;
    
    // ============================================
    // 1. VERIFICAR SI ESTÁ CERRADO (SOLO EN ESTA SESIÓN)
    // ============================================
    
    function isCTAClosed() {
        // Usamos sessionStorage en lugar de localStorage
        // sessionStorage se limpia automáticamente al cerrar la pestaña/recargar
        return sessionStorage.getItem('floatingCTAClosed') === 'true';
    }
    
    // ============================================
    // 2. MOSTRAR AL HACER SCROLL
    // ============================================
    
    function checkFloatingVisibility() {
        if (!floatingCTA) return;
        
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        const pageHeight = document.body.scrollHeight;
        
        // Verificar si está cerrado en esta sesión
        if (isCTAClosed()) return;
        
        // Mostrar después de scrollear 400px y antes del footer
        const footer = document.querySelector('.footer');
        const footerTop = footer ? footer.offsetTop : pageHeight;
        const isBeforeFooter = scrollPosition + windowHeight < footerTop - 100;
        
        if (scrollPosition > 400 && isBeforeFooter && !isVisible) {
            floatingCTA.classList.add('show');
            isVisible = true;
        } else if ((scrollPosition <= 400 || !isBeforeFooter) && isVisible) {
            floatingCTA.classList.remove('show');
            isVisible = false;
        }
    }
    
    // ============================================
    // 3. SCROLL AL TOUR
    // ============================================
    
    window.scrollToTour = function() {
        const tourSection = document.getElementById('tour');
        if (tourSection) {
            tourSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Pequeña animación en el botón
            const btn = document.querySelector('.floating-button');
            if (btn) {
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 200);
            }
        }
    };
    
    // ============================================
    // 4. CERRAR CTA (SOLO POR ESTA SESIÓN)
    // ============================================
    
    window.closeFloatingCTA = function() {
        if (floatingCTA) {
            floatingCTA.classList.remove('show');
            isVisible = false;
            // Guardar en sessionStorage (se borra al recargar la página)
            sessionStorage.setItem('floatingCTAClosed', 'true');
        }
    };
    
    // ============================================
    // 5. EVENTOS DE SCROLL
    // ============================================
    
    window.addEventListener('scroll', checkFloatingVisibility);
    window.addEventListener('resize', checkFloatingVisibility);
    window.addEventListener('load', checkFloatingVisibility);
    
    // ============================================
    // 6. MOSTRAR AL SALIR DEL MOUSE (OPCIONAL)
    // ============================================
    
    let mouseLeft = false;
    document.addEventListener('mouseleave', function(event) {
        if (event.clientY < 0 && !mouseLeft && !isVisible) {
            if (!isCTAClosed() && floatingCTA) {
                floatingCTA.classList.add('show');
                isVisible = true;
                mouseLeft = true;
                setTimeout(() => { mouseLeft = false; }, 1000);
            }
        }
    });
    
    // ============================================
    // 7. ACTUALIZAR CUPOS DINÁMICAMENTE (OPCIONAL)
    // ============================================
    
    let cupos = 8;
    const cuposElement = document.querySelector('.floating-text strong');
    
    function actualizarCupos() {
        if (cupos > 1 && Math.random() > 0.7) {
            cupos--;
            if (cuposElement) {
                cuposElement.innerHTML = `Últimos ${cupos} cupos · $520 USD`;
                if (cupos <= 3) {
                    cuposElement.style.color = '#ff4757';
                }
            }
        }
    }
    
    // Actualizar cupos cada 5-10 minutos simulando demanda
    setInterval(actualizarCupos, Math.random() * 300000 + 300000);
    
});