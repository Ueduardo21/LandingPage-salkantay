// ============================================
<<<<<<< HEAD
// HEADER - NAVEGACIÓN MEJORADA
=======
// HEADER - JAVASCRIPT
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
<<<<<<< HEAD
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
=======
    // ============================================
    // 1. SCROLL EFFECT (CAMBIA ESTILO AL SCROLLEAR)
    // ============================================
    
    const header = document.querySelector('.header');
    
    function handleScroll() {
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
<<<<<<< HEAD
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
=======
    }
    
    window.addEventListener('scroll', handleScroll);
    handleScroll();
    
    // ============================================
    // 2. ACTIVE LINK SEGÚN SECCIÓN VISIBLE
    // ============================================
    
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    function updateActiveLink() {
        const scrollPosition = window.scrollY + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
            }
        });
    }
    
<<<<<<< HEAD
    // Cerrar menú al hacer click en un link
    navLinks.forEach(link => {
=======
    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink();
    
    // ============================================
    // 3. SMOOTH SCROLL (NAVEGACIÓN SUAVE)
    // ============================================
    
    document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
<<<<<<< HEAD
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
=======
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Cerrar menú mobile si está abierto
                closeMobileMenu();
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
            }
        });
    });
    
<<<<<<< HEAD
    // Re-evaluar botón móvil al redimensionar
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            const mobileBtn = document.querySelector('.mobile-reservar-btn');
            if (mobileBtn) mobileBtn.remove();
        }
    });
    
=======
    // ============================================
    // 4. MENÚ MOBILE
    // ============================================
    
    const mobileMenu = document.getElementById('mobileMenu');
    const openBtn = document.getElementById('mobileMenuBtn');
    const closeBtn = document.getElementById('closeMobileMenu');
    
    function openMobileMenu() {
        mobileMenu.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
    }
    
    if (openBtn) openBtn.addEventListener('click', openMobileMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMobileMenu);
    
    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', function(event) {
        if (mobileMenu && mobileMenu.classList.contains('open')) {
            if (!mobileMenu.contains(event.target) && !openBtn.contains(event.target)) {
                closeMobileMenu();
            }
        }
    });
    
    // ============================================
    // 5. PREVENT SCROLL EN EL MENÚ MOBILE
    // ============================================
    
    if (mobileMenu) {
        mobileMenu.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, { passive: false });
    }
    
>>>>>>> 4ddf37f2b57f811b1267c9a3529529a17241979b
});