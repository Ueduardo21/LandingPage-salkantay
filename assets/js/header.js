// ============================================
// HEADER - JAVASCRIPT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. SCROLL EFFECT (CAMBIA ESTILO AL SCROLLEAR)
    // ============================================
    
    const header = document.querySelector('.header');
    
    function handleScroll() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
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
            }
        });
    }
    
    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink();
    
    // ============================================
    // 3. SMOOTH SCROLL (NAVEGACIÓN SUAVE)
    // ============================================
    
    document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Cerrar menú mobile si está abierto
                closeMobileMenu();
            }
        });
    });
    
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
    
});