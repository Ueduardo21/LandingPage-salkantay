// ============================================
// GALERÍA - JAVASCRIPT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. FILTROS POR CATEGORÍA
    // ============================================
    
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galeriaItems = document.querySelectorAll('.galeria-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover active de todos
            filterBtns.forEach(b => b.classList.remove('active'));
            // Agregar active al actual
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            galeriaItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.6s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // ============================================
    // 2. LIGHTBOX PARA IMÁGENES
    // ============================================
    
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.querySelector('.lightbox-image');
    const lightboxCaption = document.querySelector('.lightbox-caption');
    const lightboxClose = document.querySelector('.lightbox-close');
    const lightboxPrev = document.querySelector('.lightbox-prev');
    const lightboxNext = document.querySelector('.lightbox-next');
    
    let currentImageIndex = 0;
    let currentImages = [];
    
    // Abrir lightbox al hacer clic en imagen
    document.querySelectorAll('.galeria-item:not(.video) .galeria-image').forEach((item, index) => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
            const parent = this.closest('.galeria-item');
            const img = this.querySelector('img');
            const caption = parent.querySelector('.galeria-caption')?.innerText || '';
            
            // Obtener todas las imágenes (no videos)
            currentImages = Array.from(document.querySelectorAll('.galeria-item:not(.video) .galeria-image img'));
            currentImageIndex = currentImages.indexOf(img);
            
            lightboxImg.src = img.src;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Cerrar lightbox
    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });
    
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Navegación lightbox
    lightboxPrev.addEventListener('click', function(e) {
        e.stopPropagation();
        currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
        const img = currentImages[currentImageIndex];
        const parent = img.closest('.galeria-item');
        const caption = parent.querySelector('.galeria-caption')?.innerText || '';
        
        lightboxImg.src = img.src;
        lightboxCaption.textContent = caption;
    });
    
    lightboxNext.addEventListener('click', function(e) {
        e.stopPropagation();
        currentImageIndex = (currentImageIndex + 1) % currentImages.length;
        const img = currentImages[currentImageIndex];
        const parent = img.closest('.galeria-item');
        const caption = parent.querySelector('.galeria-caption')?.innerText || '';
        
        lightboxImg.src = img.src;
        lightboxCaption.textContent = caption;
    });
    
    // Teclado
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') lightboxPrev.click();
        if (e.key === 'ArrowRight') lightboxNext.click();
    });
    
    // ============================================
    // 3. VÍDEOS
    // ============================================
    
    const videoModal = document.getElementById('videoModal');
    const modalVideo = document.getElementById('modalVideo');
    const videoModalClose = document.querySelector('.video-modal-close');
    
    document.querySelectorAll('.galeria-item.video .video-play-btn, .galeria-item.video .galeria-overlay').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const parent = this.closest('.galeria-item');
            const video = parent.querySelector('.galeria-video');
            const videoSrc = video.querySelector('source')?.src;
            
            if (videoSrc) {
                modalVideo.querySelector('source').src = videoSrc;
                modalVideo.load();
                videoModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                modalVideo.play();
            }
        });
    });
    
    function closeVideoModal() {
        videoModal.classList.remove('active');
        modalVideo.pause();
        modalVideo.currentTime = 0;
        document.body.style.overflow = '';
    }
    
    videoModalClose.addEventListener('click', closeVideoModal);
    videoModal.addEventListener('click', function(e) {
        if (e.target === videoModal) closeVideoModal();
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && videoModal.classList.contains('active')) {
            closeVideoModal();
        }
    });
    
    // ============================================
    // 4. CARGA DE MÁS FOTOS (EJEMPLO)
    // ============================================
    
    window.loadMorePhotos = function() {
        alert('📸 Próximamente: Más fotos y videos de nuestros viajeros.\n\n¡Síguenos en redes para no perderte ninguna actualización!');
        // Aquí puedes implementar carga dinámica desde un backend
    };
    
    // ============================================
    // 5. ANIMACIÓN AL SCROLL
    // ============================================
    
    const galeriaItemsScroll = document.querySelectorAll('.galeria-item');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    galeriaItemsScroll.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.6s ease';
        observer.observe(item);
    });
    
    // ============================================
    // 6. PAUSA VIDEOS AL SALIR DEL VIEWPORT
    // ============================================
    
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target;
            if (!entry.isIntersecting) {
                video.pause();
            }
        });
    }, { threshold: 0.2 });
    
    document.querySelectorAll('.galeria-video').forEach(video => {
        videoObserver.observe(video);
    });
    
});