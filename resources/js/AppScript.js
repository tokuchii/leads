// Paste the content of the <script> block from App.vue here, as a JS module export for Vue SFC.
export default {
    name: 'App',
    data() {
        return {
            activeSection: 'home'
        }
    },
    mounted() {
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMenuButton = document.getElementById('close-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileNav = document.querySelector('.mobile-nav');

        // Search functionality
        const searchIcon = document.getElementById('search-icon');
        const searchContainer = document.getElementById('search-container');
        const closeSearch = document.getElementById('close-search');
        const navItems = document.getElementById('nav-items');
        const searchInput = document.querySelector('.search-input');

        // Mobile search functionality
        const mobileSearchIcon = document.getElementById('mobile-search-icon');
        const mobileSearchContainer = document.getElementById('mobile-search-container');
        const mobileSearchInput = mobileSearchContainer.querySelector('input');
        const mobilePhoneIcon = document.getElementById('mobile-phone-icon');

        // Mobile search functionality
        function toggleMobileSearch() {
            const isVisible = !mobileSearchContainer.classList.contains('hidden');

            // Toggle visibility
            mobileSearchContainer.classList.toggle('hidden');
            mobileSearchIcon.style.display = isVisible ? 'inline-block' : 'none';
            mobilePhoneIcon.style.display = isVisible ? 'inline-block' : 'none';

            if (!isVisible) {
                mobileSearchInput.focus();
                mobileSearchInput.value = '';
            } else {
                mobileSearchInput.value = '';
            }
        }

        mobileSearchIcon.addEventListener('click', toggleMobileSearch);

        // Close mobile search when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileSearchContainer.classList.contains('hidden') && 
                !mobileSearchContainer.contains(e.target) && 
                !mobileSearchIcon.contains(e.target)) {
                toggleMobileSearch();
            }
        });

        // Desktop search functionality
        searchIcon.addEventListener('click', () => {
            // Only trigger if we're in desktop view
            if (window.innerWidth >= 818) {
                searchContainer.classList.add('active');
                navItems.classList.add('hidden');
                searchInput.focus();
            }
        });

        closeSearch.addEventListener('click', () => {
            searchContainer.classList.remove('active');
            navItems.classList.remove('hidden');
            searchInput.value = '';
        });

        // Close desktop search when clicking outside
        document.addEventListener('click', (e) => {
            const isClickInsideSearch = searchContainer.contains(e.target);
            const isClickOnSearchIcon = searchIcon.contains(e.target);

            // Check if desktop nav is visible and the click is outside the search container and icon
            if (window.innerWidth >= 818 && !isClickInsideSearch && !isClickOnSearchIcon) {
                searchContainer.classList.remove('active');
                navItems.classList.remove('hidden');
                searchInput.value = '';
            }
        });

        // Function to check if mobile nav is visible
        function isMobileNavVisible() {
            return window.getComputedStyle(mobileNav).display !== 'none';
        }

        // Function to close menu
        function closeMenu() {
            mobileMenu.classList.remove('active');
        }

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        closeMenuButton.addEventListener('click', closeMenu);

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu.classList.contains('active') && 
                !mobileMenu.contains(e.target) && 
                !mobileMenuButton.contains(e.target)) {
                closeMenu();
            }
        });

        // Close menu when window is resized to desktop view
        window.addEventListener('resize', () => {
            if (isMobileNavVisible()) {
                // Reset search state only when mobile menu is visible
                searchContainer.classList.remove('active');
                navItems.classList.remove('hidden');
                searchInput.value = '';
            }
            if (!isMobileNavVisible()) {
                closeMenu();
            }
        });

        // Setup scroll progress indicator with improved accuracy
        window.addEventListener('scroll', () => {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.querySelector('.scroll-progress').style.width = `${scrolled}%`;
        });

        // Improved scroll spy functionality with section order awareness
        const sectionOrder = ['home', 'about', 'products', 'news', 'careers', 'contact'];
        let lastScrollPosition = 0;
        let scrollTimeout;

        const observerOptions = {
            root: null,
            rootMargin: '-10% 0px -10% 0px', // Adjusted for more precise detection
            threshold: [0.1, 0.3, 0.5, 0.7, 0.9] // More granular thresholds
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id;
                    const currentIndex = sectionOrder.indexOf(sectionId);
                    const lastIndex = sectionOrder.indexOf(this.activeSection);
                    
                    // Special handling for products, news, and contact sections
                    if (sectionId === 'products' || sectionId === 'news' || sectionId === 'contact') {
                        if (entry.intersectionRatio > 0.2) {
                            this.activeSection = sectionId;
                        }
                    // Slightly higher threshold for careers for more natural activation
                    } else if (sectionId === 'careers') {
                        if (entry.intersectionRatio > 0.3) {
                            this.activeSection = sectionId;
                        }
                    } else {
                        if (currentIndex > lastIndex || entry.intersectionRatio > 0.5) {
                            this.activeSection = sectionId;
                        }
                    }
                }
            });
        }, observerOptions);

        // Observe all sections with improved error handling
        document.querySelectorAll('section[id]').forEach(section => {
            if (section) {
                observer.observe(section);
            }
        });

        // Enhanced scroll event listener for more accurate section detection
        window.addEventListener('scroll', () => {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(() => {
                const sections = document.querySelectorAll('section[id]');
                const scrollPosition = window.pageYOffset;
                const scrollDirection = scrollPosition > lastScrollPosition ? 'down' : 'up';
                lastScrollPosition = scrollPosition;
                const viewportHeight = window.innerHeight;
                const viewportMiddle = viewportHeight / 2;
                let mostVisibleSection = null;
                let maxVisibility = 0;
                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    const sectionId = section.getAttribute('id');
                    const currentIndex = sectionOrder.indexOf(sectionId);
                    const visibleTop = Math.max(0, rect.top);
                    const visibleBottom = Math.min(viewportHeight, rect.bottom);
                    const visibleHeight = Math.max(0, visibleBottom - visibleTop);
                    const visibility = visibleHeight / viewportHeight;
                    if (sectionId === 'products' || sectionId === 'news' || sectionId === 'contact') {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > 0.2) {
                                this.activeSection = sectionId;
                            }
                        }
                    // Slightly higher threshold for careers
                    } else if (sectionId === 'careers') {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > 0.3) {
                                this.activeSection = sectionId;
                            }
                        }
                    } else {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > maxVisibility) {
                                maxVisibility = visibility;
                                mostVisibleSection = {
                                    id: sectionId,
                                    index: currentIndex
                                };
                            }
                        }
                    }
                });
                if (mostVisibleSection && maxVisibility > 0.3) {
                    const currentIndex = sectionOrder.indexOf(this.activeSection);
                    if (mostVisibleSection.index > currentIndex || 
                        (scrollDirection === 'up' && mostVisibleSection.index === currentIndex - 1)) {
                        this.activeSection = mostVisibleSection.id;
                    }
                }
            }, 50);
        });
    },
    methods: {
        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                // Close mobile menu if it's open
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                }

                // Get the section's position relative to the viewport
                const sectionTop = section.getBoundingClientRect().top + window.pageYOffset;
                
                // Get current scroll position
                const startPosition = window.pageYOffset;
                
                // Calculate the distance to scroll
                const distance = sectionTop - startPosition;
                
                // Animation duration in milliseconds
                const duration = 1000;
                
                // Start time
                let start = null;
                
                // Animation function
                function animation(currentTime) {
                    if (start === null) start = currentTime;
                    const timeElapsed = currentTime - start;
                    const progress = Math.min(timeElapsed / duration, 1);
                    
                    // Easing function for smooth animation
                    const easeInOutCubic = progress => {
                        return progress < 0.5
                            ? 4 * progress * progress * progress
                            : 1 - Math.pow(-2 * progress + 2, 3) / 2;
                    };
                    
                    // Calculate new position
                    const newPosition = startPosition + (distance * easeInOutCubic(progress));
                    window.scrollTo(0, newPosition);
                    
                    // Continue animation if not complete
                    if (timeElapsed < duration) {
                        requestAnimationFrame(animation);
                    }
                }
                
                // Start animation
                requestAnimationFrame(animation);
            }
        }
    }
} 