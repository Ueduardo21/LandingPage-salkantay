// ============================================
// ANIMACIONES PARA PRUEBA SOCIAL
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. REVELACIÓN DE ELEMENTOS AL SCROLL (Intersection Observer)
    // ============================================
    
    const animatedElements = document.querySelectorAll('.review-card, .trust-stat, .cert-item, .rating-card');
    
    const observerOptions = {
        threshold: 0.2, // Se activa cuando el 20% del elemento es visible
        rootMargin: '0px 0px -50px 0px' // Pequeño offset para mejor timing
    };
    
    const fadeInObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target); // Solo anima una vez
            }
        });
    }, observerOptions);
    
    animatedElements.forEach(element => {
        element.classList.add('animate-ready');
        fadeInObserver.observe(element);
    });
    
    // ============================================
    // 2. CONTADORES NUMÉRICOS (Estadísticas)
    // ============================================
    
    function animateNumbers() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        statNumbers.forEach(stat => {
            const targetNumber = parseInt(stat.innerText);
            if (isNaN(targetNumber)) return;
            
            let currentNumber = 0;
            const duration = 2000; // 2 segundos
            const increment = targetNumber / (duration / 16); // 60 FPS
            const hasPlus = stat.innerText.includes('+');
            const originalText = stat.innerText;
            
            const updateNumber = () => {
                currentNumber += increment;
                if (currentNumber < targetNumber) {
                    stat.innerText = Math.floor(currentNumber) + (hasPlus ? '+' : '');
                    requestAnimationFrame(updateNumber);
                } else {
                    stat.innerText = targetNumber + (hasPlus ? '+' : '');
                }
            };
            
            // Solo animar si el elemento está visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateNumber();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(stat);
        });
    }
    
    animateNumbers();
    
    // ============================================
    // 3. ANIMACIÓN DE ESTRELLAS (Rating)
    // ============================================
    
    function animateStars() {
        const ratingCard = document.querySelector('.rating-card');
        if (!ratingCard) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const stars = document.querySelectorAll('.rating-stars .stars i');
                    stars.forEach((star, index) => {
                        setTimeout(() => {
                            star.style.animation = 'starPop 0.5s ease forwards';
                        }, index * 100);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(ratingCard);
    }
    
    animateStars();
    
    // ============================================
    // 4. EFECTO DE PARALLAXE SUAVE EN SECCIÓN
    // ============================================
    
    const socialProofSection = document.querySelector('.social-proof');
    if (socialProofSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const sectionTop = socialProofSection.offsetTop;
            const sectionHeight = socialProofSection.offsetHeight;
            
            if (scrolled > sectionTop - window.innerHeight && scrolled < sectionTop + sectionHeight) {
                const parallaxValue = (scrolled - sectionTop) * 0.3;
                socialProofSection.style.backgroundPosition = `50% ${parallaxValue}px`;
            }
        });
    }
    
    // ============================================
    // 5. HOVER ANIMATION MEJORADA (Tilt effect en tarjetas)
    // ============================================
    
    const reviewCards = document.querySelectorAll('.review-card');
    
    reviewCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
        });
    });
    
    // ============================================
    // 6. ANIMACIÓN DE ENTRADA PARA EL BADGE
    // ============================================
    
    const proofBadge = document.querySelector('.proof-badge');
    if (proofBadge) {
        setTimeout(() => {
            proofBadge.classList.add('badge-pulse');
        }, 500);
    }
    
    // ============================================
    // 7. EFECTO DE TIPEO PARA EL TÍTULO (Opcional)
    // ============================================
    
    const titleElement = document.querySelector('.proof-header h2');
    if (titleElement && !titleElement.hasAttribute('data-typed')) {
        const originalText = titleElement.innerHTML;
        const highlightText = titleElement.querySelector('.highlight')?.innerText || '';
        
        // Pequeña animación de revelación para el título
        titleElement.style.opacity = '0';
        titleElement.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            titleElement.style.transition = 'all 0.6s ease';
            titleElement.style.opacity = '1';
            titleElement.style.transform = 'translateY(0)';
        }, 200);
    }
    
    // ============================================
    // 8. EFECTO DE ONDA EN CERTIFICACIONES
    // ============================================
    
    const certItems = document.querySelectorAll('.cert-item');
    certItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.classList.add('cert-wave');
            setTimeout(() => {
                item.classList.remove('cert-wave');
            }, 600);
        });
    });
    
    // ============================================
    // 9. ANIMACIÓN DE LA CALIFICACIÓN (Progress bars)
    // ============================================
    
    function animateRatingBars() {
        const ratingDetails = document.querySelector('.rating-details');
        if (!ratingDetails) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const platforms = document.querySelectorAll('.rating-platform');
                    platforms.forEach((platform, index) => {
                        setTimeout(() => {
                            platform.classList.add('platform-slide-in');
                        }, index * 150);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(ratingDetails);
    }
    
    animateRatingBars();
    
    // ============================================
    // 10. SCROLL REVEAL SECUENCIAL
    // ============================================
    
    function revealSequential() {
        const sections = document.querySelectorAll('.reviews-grid > *, .trust-stats > *, .certifications > *');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('sequential-reveal');
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        sections.forEach(section => {
            section.classList.add('sequential-ready');
            observer.observe(section);
        });
    }
    
    revealSequential();
    
    // ============================================
    // 11. EFECTO DE PARPADEO EN EL CTA (Atrae atención)
    // ============================================
    
    const ctaButton = document.querySelector('.proof-cta .btn-outline');
    if (ctaButton) {
        setInterval(() => {
            ctaButton.classList.add('cta-pulse');
            setTimeout(() => {
                ctaButton.classList.remove('cta-pulse');
            }, 1000);
        }, 5000);
    }
    
    // ============================================
    // 12. ANIMACIÓN AL CARGAR LA PÁGINA
    // ============================================
    
    window.addEventListener('load', () => {
        document.body.classList.add('loaded');
        
        // Animación de entrada para toda la sección
        const socialProof = document.querySelector('.social-proof');
        if (socialProof) {
            socialProof.style.animation = 'sectionFadeIn 0.8s ease';
        }
    });
    
});