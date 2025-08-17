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

        let ticking = false;

        const updateProgress = () => {
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.offsetHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            progressBar.style.width = `${scrollPercent}%`;
            
            // Add glow effect at certain scroll percentages
            if (scrollPercent > 50) {
                progressBar.style.boxShadow = '0 0 20px rgba(198, 252, 166, 0.6)';
            } else {
                progressBar.style.boxShadow = '0 0 10px rgba(198, 252, 166, 0.3)';
            }
            
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

        // Handle all internal navigation
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link || !link.href || !link.href.startsWith(window.location.origin)) return;

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

// Enhanced Lenis configuration
class EnhancedLenis {
    constructor() {
        this.init();
    }

    init() {
        if (typeof Lenis === 'undefined') {
            console.log('Lenis not loaded');
            return;
        }

        this.lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        this.setupRaf();
    }

    setupRaf() {
        const raf = (time) => {
            this.lenis.raf(time);
            requestAnimationFrame(raf);
        };
        requestAnimationFrame(raf);
    }

    // Method to scroll to element with easing
    scrollTo(target, options = {}) {
        const defaultOptions = {
            offset: 0,
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
        };

        const finalOptions = { ...defaultOptions, ...options };
        
        if (typeof target === 'string') {
            target = document.querySelector(target);
        }

        if (target) {
            const targetPosition = target.offsetTop - finalOptions.offset;
            this.lenis.scrollTo(targetPosition, finalOptions);
        }
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing animations...');
    
    // Initialize scroll animations
    new ScrollAnimations();
    
    // Initialize enhanced Lenis
    new EnhancedLenis();
    
    // Add loading animation
    document.body.classList.add('loaded');
    
    console.log('Animations initialized successfully!');
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ScrollAnimations, EnhancedLenis };
}
