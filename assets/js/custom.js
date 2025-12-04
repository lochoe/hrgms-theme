/**
 * File: custom.js
 * Purpose: Custom JavaScript for HRGMS Theme
 * Exposes: DOM ready functions, smooth scroll, navbar behavior
 * Notes: Depends on Bootstrap 5 being loaded first
 */

(function() {
    'use strict';

    /**
     * DOM Ready Handler
     * What: Execute functions when DOM is fully loaded
     */
    document.addEventListener('DOMContentLoaded', function() {
        initSmoothScroll();
        initNavbarShrink();
        initPriceAnimation();
    });

    /**
     * initSmoothScroll
     * What: Enable smooth scrolling for anchor links
     * Input: none
     * Output: void
     * Side effects: Adds click event listeners to anchor links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    }
                }
            });
        });
    }

    /**
     * initNavbarShrink
     * What: Add/remove class when scrolling for navbar effect
     * Input: none
     * Output: void
     * Side effects: Toggles 'scrolled' class on header
     */
    function initNavbarShrink() {
        const header = document.querySelector('.hrgms-header');
        
        if (!header) return;
        
        function checkScroll() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll(); // Check on load
    }

    /**
     * initPriceAnimation
     * What: Animate price cards on scroll into view
     * Input: none
     * Output: void
     * Side effects: Adds animation classes to elements
     */
    function initPriceAnimation() {
        const priceCards = document.querySelectorAll('.price-card');
        
        if (!priceCards.length) return;

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry, index) {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        priceCards.forEach(function(card) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    }

    /**
     * formatCurrency
     * What: Format number as Malaysian Ringgit
     * Input: number - the value to format
     * Output: string - formatted currency string
     */
    window.formatCurrency = function(number) {
        return new Intl.NumberFormat('ms-MY', {
            style: 'currency',
            currency: 'MYR',
            minimumFractionDigits: 2
        }).format(number);
    };

})();


