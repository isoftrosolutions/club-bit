// Club Abhiyanta - Enhanced Premium Interactions Script

document.addEventListener('DOMContentLoaded', () => {
    // 1. Enhanced Header Scroll Effect with Performance Optimization
    const header = document.getElementById('main-header');
    let lastScrollY = window.scrollY;
    let ticking = false;

    function updateHeader() {
        const scrollY = window.scrollY;

        if (scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Add subtle parallax effect to header
        const translateY = Math.min(scrollY * 0.1, 20);
        header.style.transform = `translateX(-50%) translateY(${translateY}px)`;

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick, { passive: true });

    // 2. Enhanced Reveal Animations with Stagger Effect
    const reveals = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add staggered delay for multiple elements
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    reveals.forEach(reveal => revealObserver.observe(reveal));

    // 3. Enhanced Smooth Scrolling with Offset for Fixed Header
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = header.offsetHeight;
                const elementPosition = target.offsetTop;
                const offsetPosition = elementPosition - headerOffset - 20;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 4. Enhanced Gallery Interactions with Preload
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach((item, index) => {
        // Preload images for better performance
        const img = item.querySelector('img');
        if (img) {
            const imgSrc = img.src;
            const preloadImg = new Image();
            preloadImg.src = imgSrc;
        }

        // Enhanced hover effects
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'translateY(-8px) scale(1.02)';
            img.style.transform = 'scale(1.1)';

            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.6s ease;
                pointer-events: none;
            `;
            item.appendChild(ripple);

            setTimeout(() => {
                ripple.style.width = '300px';
                ripple.style.height = '300px';
                ripple.style.opacity = '0';
            }, 10);

            setTimeout(() => ripple.remove(), 600);
        });

        item.addEventListener('mouseleave', () => {
            item.style.transform = 'translateY(0) scale(1)';
            img.style.transform = 'scale(1)';
        });

        // Click effect for mobile
        item.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                item.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    item.style.transform = 'scale(1)';
                }, 150);
            }
        });
    });

    // 5. Enhanced Card Interactions
    const cards = document.querySelectorAll('.premium-card, .team-card');
    cards.forEach((card, index) => {
        card.addEventListener('mouseenter', () => {
            // Add subtle rotation based on mouse position
            card.addEventListener('mousemove', handleCardMouseMove);
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.removeEventListener('mousemove', handleCardMouseMove);
        });

        function handleCardMouseMove(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(20px)`;
        }
    });

    // 6. Dynamic Background Effects
    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        let mouseX = 0;
        let mouseY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX / window.innerWidth;
            mouseY = e.clientY / window.innerHeight;

            // Subtle parallax effect on background elements
            const glows = document.querySelectorAll('.hero-glow');
            glows.forEach((glow, index) => {
                const speed = (index + 1) * 20;
                glow.style.transform = `translate(${mouseX * speed - speed/2}px, ${mouseY * speed - speed/2}px)`;
            });
        });
    }

    // 7. Performance Optimization - Lazy Loading for Images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // 8. Enhanced Scroll Progress Indicator
    const scrollProgress = document.createElement('div');
    scrollProgress.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: var(--gradient-primary);
        z-index: 999;
        transition: width 0.25s ease;
        pointer-events: none;
    `;
    document.body.appendChild(scrollProgress);

    function updateScrollProgress() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        scrollProgress.style.width = scrollPercent + '%';
    }

    window.addEventListener('scroll', updateScrollProgress, { passive: true });

    // 9. Mobile Touch Optimizations
    if ('ontouchstart' in window) {
        // Add touch feedback for interactive elements
        const interactiveElements = document.querySelectorAll('.premium-card, .team-card, .gallery-item, .btn');
        interactiveElements.forEach(element => {
            element.addEventListener('touchstart', () => {
                element.style.transform = 'scale(0.98)';
            });

            element.addEventListener('touchend', () => {
                setTimeout(() => {
                    element.style.transform = '';
                }, 150);
            });
        });
    }

    // 10. Loading Complete
    window.addEventListener('load', () => {
        document.body.classList.add('loaded');
    });
});
