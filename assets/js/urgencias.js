// ============================================
// URGENCIA / ESCASEZ - JAVASCRIPT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. CONTADOR REGRESIVO
    // ============================================
    
    // Fecha objetivo: 3 días desde ahora (cambia según necesites)
    const targetDate = new Date();
    targetDate.setDate(targetDate.getDate() + 3);
    targetDate.setHours(23, 59, 59, 999);
    
    function updateCountdown() {
        const now = new Date();
        const diff = targetDate - now;
        
        if (diff <= 0) {
            // La oferta terminó
            document.getElementById('dias').innerText = '00';
            document.getElementById('horas').innerText = '00';
            document.getElementById('minutos').innerText = '00';
            document.getElementById('segundos').innerText = '00';
            
            // Mostrar mensaje de oferta terminada
            const countdownContainer = document.querySelector('.countdown-container');
            if (countdownContainer && !document.querySelector('.offer-ended')) {
                const endedMsg = document.createElement('div');
                endedMsg.className = 'offer-ended';
                endedMsg.innerHTML = '<i class="fas fa-clock"></i> Oferta finalizada. ¡Contáctanos para nuevas promociones!';
                endedMsg.style.cssText = 'margin-top: 15px; font-size: 0.8rem; background: rgba(0,0,0,0.3); padding: 8px; border-radius: 10px;';
                countdownContainer.appendChild(endedMsg);
            }
            return;
        }
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('dias').innerText = days.toString().padStart(2, '0');
        document.getElementById('horas').innerText = hours.toString().padStart(2, '0');
        document.getElementById('minutos').innerText = minutes.toString().padStart(2, '0');
        document.getElementById('segundos').innerText = seconds.toString().padStart(2, '0');
    }
    
    // Iniciar contador
    updateCountdown();
    setInterval(updateCountdown, 1000);
    
    // ============================================
    // 2. ANIMACIÓN DE LA BARRA DE CUPOS
    // ============================================
    
    const cuposObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target.querySelector('.cupos-progress');
                if (progressBar) {
                    const width = progressBar.style.width;
                    progressBar.style.width = '0%';
                    setTimeout(() => {
                        progressBar.style.width = width;
                    }, 100);
                }
                cuposObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const cuposCard = document.querySelector('.escasez-card:first-child');
    if (cuposCard) {
        cuposObserver.observe(cuposCard);
    }
    
    // ============================================
    // 3. RESERVAS RECIENTES (SIMULADAS CON ANIMACIÓN)
    // ============================================
    
    const reservasContainer = document.getElementById('reservasRecientes');
    const nombres = ['Ana', 'Javier', 'Sofía', 'Miguel', 'Valentina', 'Andrés', 'Camila', 'Diego'];
    
    function agregarReservaReciente() {
        if (!reservasContainer) return;
        
        const nombreRandom = nombres[Math.floor(Math.random() * nombres.length)];
        const tiempoRandom = Math.floor(Math.random() * 10) + 1;
        
        const nuevaReserva = document.createElement('div');
        nuevaReserva.className = 'reserva-item';
        nuevaReserva.style.animation = 'slideIn 0.5s ease';
        nuevaReserva.innerHTML = `
            <i class="fas fa-user-check"></i>
            <div>
                <strong>${nombreRandom} ${Math.random() > 0.5 ? 'G.' : 'R.'}</strong> reservó hace <span class="tiempo">${tiempoRandom} ${tiempoRandom === 1 ? 'minuto' : 'minutos'}</span>
            </div>
        `;
        
        reservasContainer.insertBefore(nuevaReserva, reservasContainer.firstChild);
        
        // Mantener solo las últimas 5 reservas
        while (reservasContainer.children.length > 5) {
            reservasContainer.removeChild(reservasContainer.lastChild);
        }
    }
    
    // Agregar nueva reserva cada 30-60 segundos
    if (reservasContainer) {
        setInterval(agregarReservaReciente, Math.random() * 30000 + 30000);
    }
    
    // ============================================
    // 4. ACTUALIZAR CONTADOR DE PRECIO PROMO
    // ============================================
    
    function updatePromoTimer() {
        const promoEndDate = new Date();
        promoEndDate.setDate(promoEndDate.getDate() + 2);
        promoEndDate.setHours(14, 0, 0, 0);
        
        const now = new Date();
        const diff = promoEndDate - now;
        
        if (diff <= 0) return;
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        
        const promoText = document.querySelector('.promo-timer');
        if (promoText) {
            promoText.innerHTML = `<i class="fas fa-clock"></i> Válido por: <strong>${days} días ${hours} horas</strong>`;
        }
    }
    
    updatePromoTimer();
    setInterval(updatePromoTimer, 3600000); // Actualizar cada hora
    
    // ============================================
    // 5. EFECTO DE PARPADEO EN CUPOS RESTANTES
    // ============================================
    
    const cuposRestantes = document.querySelector('.cupos-restantes');
    if (cuposRestantes) {
        setInterval(() => {
            cuposRestantes.style.opacity = '0.7';
            setTimeout(() => {
                cuposRestantes.style.opacity = '1';
            }, 500);
        }, 2000);
    }
    
    // ============================================
    // 6. ANIMACIONES AL SCROLL
    // ============================================
    
    const urgenciaElements = document.querySelectorAll('.escasez-card, .urgencia-alerta, .urgencia-testimonio, .urgencia-cta');
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    urgenciaElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        scrollObserver.observe(el);
    });
    
});