// ============================================
// HEADER - NAVEGACIÓN MEJORADA
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    const header = document.querySelector('.header');
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');
    const body = document.body;
    
    // Agregar botón de reserva en móvil
    function addMobileReservarBtn() {
        const existingBtn = document.querySelector('.mobile-reservar-btn');
        if (!existingBtn && window.innerWidth <= 768) {
            const mobileBtn = document.createElement('button');
            mobileBtn.className = 'mobile-reservar-btn';
            mobileBtn.innerHTML = '<i class="fas fa-calendar-check"></i> Reservar ahora';
            mobileBtn.onclick = () => openReservaModal();
            navMenu.appendChild(mobileBtn);
        }
    }
    
    // ============================================
    // SCROLL: Cambiar estilo del header
    // ============================================
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // ============================================
    // MENÚ HAMBURGUESA (Mobile)
    // ============================================
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            if (navMenu.classList.contains('active')) {
                body.classList.add('menu-open');
                body.style.overflow = 'hidden';
                addMobileReservarBtn();
            } else {
                body.classList.remove('menu-open');
                body.style.overflow = '';
            }
        });
    }
    
    // Cerrar menú al hacer click en un link
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                if (navMenu.classList.contains('active')) {
                    menuToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                    body.classList.remove('menu-open');
                    body.style.overflow = '';
                }
                
                const headerHeight = header.offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
            
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // ============================================
    // DETECTAR SECCIÓN ACTIVA AL SCROLL
    // ============================================
    
    const sections = document.querySelectorAll('section[id]');
    
    window.addEventListener('scroll', function() {
        let current = '';
        const scrollPosition = window.scrollY + 120;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                current = '#' + section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === current) {
                link.classList.add('active');
            }
        });
    });
    
    // Re-evaluar botón móvil al redimensionar
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            const mobileBtn = document.querySelector('.mobile-reservar-btn');
            if (mobileBtn) mobileBtn.remove();
        }
    });
    
});