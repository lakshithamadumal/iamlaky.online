// Advanced Scroll Animations and Interactions
class ScrollAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.setupIntersectionObserver();
        this.setupParallaxEffects();
        this.setupScrollProgress();
        this.setupViewTransitions();
        this.setupInteractiveElements();
        this.setupInitialAnimations();
    }

    // Intersection Observer for scroll-triggered animations
    setupIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        const animatedElements = document.querySelectorAll('.fade-in-section, .slide-in-left, .slide-in-right, .scale-in, .rotate-in');
        animatedElements.forEach(el => observer.observe(el));

        // Observe stagger animation containers
        const staggerContainers = document.querySelectorAll('.stagger-animation');
        staggerContainers.forEach(container => observer.observe(container));
    }

    // Setup initial animations for elements already in view
    setupInitialAnimations() {
        // Trigger animations for elements already visible on page load
        setTimeout(() => {
            const animatedElements = document.querySelectorAll('.fade-in-section, .slide-in-left, .slide-in-right, .scale-in, .rotate-in');
            animatedElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animate-in');
                }, index * 200);
            });

            // Trigger stagger animations
            const staggerContainers = document.querySelectorAll('.stagger-animation');
            staggerContainers.forEach((container, index) => {
                setTimeout(() => {
                    container.classList.add('animate-in');
                }, (index + 1) * 300);
            });
        }, 500);
    }

    // Parallax effects for background elements
    setupParallaxEffects() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        // Use Locomotive Scroll's virtual scroll position if available
        if (window.locoScroll && typeof window.locoScroll.on === 'function') {
            window.locoScroll.on('scroll', (args) => {
                const scrolled = args && args.scroll && typeof args.scroll.y === 'number' ? args.scroll.y : 0;
                parallaxElements.forEach((element) => {
                    const speed = element.dataset.speed || 0.5;
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });
            return;
        }

        // Fallback to native scroll position
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(element => {
                const speed = element.dataset.speed || 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });
    }

    // Enhanced scroll progress indicator
    setupScrollProgress() {
        const progressBar = document.getElementById('scrollProgress');
        if (!progressBar) return;

        // Prefer Locomotive Scroll if present
        if (window.locoScroll && typeof window.locoScroll.on === 'function') {
            window.locoScroll.on('scroll', (args) => {
                const limit = args.limit && typeof args.limit.y === 'number' ? args.limit.y : (document.body.offsetHeight - window.innerHeight);
                const y = args.scroll && typeof args.scroll.y === 'number' ? args.scroll.y : 0;
                const percent = limit > 0 ? (y / limit) * 100 : 0;
                progressBar.style.width = `${percent}%`;
                progressBar.style.boxShadow = percent > 50
                    ? '0 0 20px rgba(198, 252, 166, 0.6)'
                    : '0 0 10px rgba(198, 252, 166, 0.3)';
            });
            return;
        }

        let ticking = false;
        const updateProgress = () => {
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.offsetHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            progressBar.style.width = `${scrollPercent}%`;
            progressBar.style.boxShadow = scrollPercent > 50
                ? '0 0 20px rgba(198, 252, 166, 0.6)'
                : '0 0 10px rgba(198, 252, 166, 0.3)';
            
            ticking = false;
        };

        const requestTick = () => {
            if (!ticking) {
                requestAnimationFrame(updateProgress);
                ticking = true;
            }
        };

        window.addEventListener('scroll', requestTick, { passive: true });
    }

    // View Transitions API implementation
    setupViewTransitions() {
        if (!document.startViewTransition) {
            console.log('View Transitions API not supported');
            return;
        }

        // Handle all internal navigation (skip in-page hash links)
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link || !link.href || !link.href.startsWith(window.location.origin)) return;

            // Allow in-page anchors (e.g. #work) to be handled by Locomotive Scroll
            if (link.hash && link.pathname === window.location.pathname) return;

            e.preventDefault();
            
            // Add transition effect
            document.startViewTransition(() => {
                window.location.href = link.href;
            });
        });

        // Handle browser back/forward
        window.addEventListener('popstate', () => {
            if (document.startViewTransition) {
                document.startViewTransition(() => {
                    // The page will naturally reload
                });
            }
        });
    }

    // Setup interactive elements
    setupInteractiveElements() {
        // Add hover effects to buttons
        const buttons = document.querySelectorAll('.btn-animate');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                this.triggerAnimation(button, 'pulse');
            });
        });

        // Add click effects
        const clickableElements = document.querySelectorAll('a, button');
        clickableElements.forEach(element => {
            element.addEventListener('click', (e) => {
                // Create ripple effect
                this.createRipple(e);
            });
        });
    }

    // Method to trigger custom animations
    triggerAnimation(element, animationType) {
        const animations = {
            'bounce': 'animate-bounce',
            'pulse': 'animate-pulse',
            'shake': 'animate-shake'
        };

        if (animations[animationType]) {
            element.classList.add(animations[animationType]);
            
            // Remove class after animation completes
            setTimeout(() => {
                element.classList.remove(animations[animationType]);
            }, 1000);
        }
    }

    // Ripple effect for clickable elements
    createRipple(event) {
        const element = event.currentTarget;
        
        const circle = document.createElement('span');
        const diameter = Math.max(element.clientWidth, element.clientHeight);
        const radius = diameter / 2;
        
        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - element.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - element.offsetTop - radius}px`;
        circle.classList.add('ripple');
        
        const ripple = element.getElementsByClassName('ripple')[0];
        if (ripple) {
            ripple.remove();
        }
        
        element.appendChild(circle);
    }
}

// Lenis-based smooth scrolling removed in favor of Locomotive Scroll

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing animations...');
    
    // Initialize scroll animations
    new ScrollAnimations();
    
    // Add loading animation
    document.body.classList.add('loaded');
    
    console.log('Animations initialized successfully!');
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ScrollAnimations, EnhancedLenis };
}
