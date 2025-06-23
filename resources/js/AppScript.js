// Paste the content of the <script> block from App.vue here, as a JS module export for Vue SFC.
import Swal from 'sweetalert2';
export default {
    name: 'App',
    data() {
        return {
            activeSection: 'home',
            activeTab: 'roots',
            formData: {
                full_name: '',
                country_code: '+63',
                contact_number: '',
                email: '',
                message: ''
            },
            isSubmitting: false,
            errorMessage: null,
            countries: [],
            showCountryDropdown: false,
            selectedCountry: null,
            phoneLengthMap: {
                // Asia
                '+63': 10, // Philippines
                '+86': 11, // China
                '+81': 10, // Japan
                '+82': 10, // South Korea
                '+91': 10, // India
                '+62': 9,  // Indonesia
                '+66': 9,  // Thailand
                '+84': 10, // Vietnam
                '+65': 8,  // Singapore
                '+60': 9,  // Malaysia
                '+852': 8, // Hong Kong
                '+886': 9, // Taiwan
                '+880': 10, // Bangladesh
                '+92': 10, // Pakistan
                '+93': 9,  // Afghanistan
                '+94': 9,  // Sri Lanka
                '+95': 9,  // Myanmar
                '+977': 10, // Nepal
                '+98': 10, // Iran
                '+964': 10, // Iraq
                '+962': 9,  // Jordan
                '+965': 8,  // Kuwait
                '+961': 8,  // Lebanon
                '+966': 9,  // Saudi Arabia
                '+971': 9,  // UAE
                '+972': 9,  // Israel
                '+973': 8,  // Bahrain
                '+974': 8,  // Qatar
                '+976': 8,  // Mongolia
                '+992': 9,  // Tajikistan
                '+993': 8,  // Turkmenistan
                '+994': 9,  // Azerbaijan
                '+995': 9,  // Georgia
                '+996': 9,  // Kyrgyzstan
                '+998': 9,  // Uzbekistan

                // Europe
                '+44': 10, // UK
                '+49': 11, // Germany
                '+33': 9,  // France
                '+39': 10, // Italy
                '+34': 9,  // Spain
                '+31': 9,  // Netherlands
                '+46': 9,  // Sweden
                '+47': 8,  // Norway
                '+45': 8,  // Denmark
                '+358': 9, // Finland
                '+48': 9,  // Poland
                '+420': 9, // Czech Republic
                '+36': 9,  // Hungary
                '+43': 11, // Austria
                '+41': 9,  // Switzerland
                '+32': 9,  // Belgium
                '+30': 10, // Greece
                '+351': 9, // Portugal
                '+353': 9, // Ireland
                '+354': 7, // Iceland
                '+355': 9, // Albania
                '+356': 8, // Malta
                '+357': 8, // Cyprus
                '+359': 9, // Bulgaria
                '+370': 8, // Lithuania
                '+371': 8, // Latvia
                '+372': 8, // Estonia
                '+373': 8, // Moldova
                '+374': 8, // Armenia
                '+375': 9, // Belarus
                '+376': 6, // Andorra
                '+377': 8, // Monaco
                '+378': 8, // San Marino
                '+380': 9, // Ukraine
                '+381': 9, // Serbia
                '+382': 8, // Montenegro
                '+383': 8, // Kosovo
                '+385': 9, // Croatia
                '+386': 8, // Slovenia
                '+387': 8, // Bosnia
                '+389': 8, // Macedonia
                '+421': 9, // Slovakia

                // Americas
                '+1': 10,  // USA/Canada
                '+55': 11, // Brazil
                '+52': 10, // Mexico
                '+54': 10, // Argentina
                '+56': 9,  // Chile
                '+57': 10, // Colombia
                '+58': 10, // Venezuela
                '+51': 9,  // Peru
                '+593': 9, // Ecuador
                '+595': 9, // Paraguay
                '+598': 8, // Uruguay
                '+591': 8, // Bolivia
                '+502': 8, // Guatemala
                '+503': 8, // El Salvador
                '+504': 8, // Honduras
                '+505': 8, // Nicaragua
                '+506': 8, // Costa Rica
                '+507': 8, // Panama
                '+509': 8, // Haiti
                '+591': 8, // Bolivia
                '+593': 9, // Ecuador
                '+595': 9, // Paraguay
                '+598': 8, // Uruguay

                // Africa
                '+27': 9,  // South Africa
                '+20': 10, // Egypt
                '+212': 9, // Morocco
                '+216': 8, // Tunisia
                '+213': 9, // Algeria
                '+234': 10, // Nigeria
                '+254': 9, // Kenya
                '+255': 9, // Tanzania
                '+256': 9, // Uganda
                '+233': 9, // Ghana
                '+225': 10, // Ivory Coast
                '+237': 9, // Cameroon
                '+236': 8, // Central African Republic
                '+235': 8, // Chad
                '+238': 7, // Cape Verde
                '+239': 7, // Sao Tome
                '+240': 9, // Equatorial Guinea
                '+241': 8, // Gabon
                '+242': 9, // Republic of Congo
                '+243': 9, // DR Congo
                '+244': 9, // Angola
                '+245': 7, // Guinea-Bissau
                '+246': 7, // British Indian Ocean Territory
                '+247': 4, // Ascension Island
                '+248': 7, // Seychelles
                '+249': 9, // Sudan
                '+250': 9, // Rwanda
                '+251': 9, // Ethiopia
                '+252': 8, // Somalia
                '+253': 8, // Djibouti
                '+257': 8, // Burundi
                '+258': 9, // Mozambique
                '+260': 9, // Zambia
                '+261': 9, // Madagascar
                '+262': 9, // Reunion
                '+263': 9, // Zimbabwe
                '+264': 9, // Namibia
                '+265': 9, // Malawi
                '+266': 8, // Lesotho
                '+267': 8, // Botswana
                '+268': 8, // Swaziland
                '+269': 7, // Comoros
                '+290': 4, // Saint Helena
                '+291': 7, // Eritrea
                '+297': 7, // Aruba
                '+298': 6, // Faroe Islands
                '+299': 6, // Greenland

                // Oceania
                '+61': 9,  // Australia
                '+64': 9,  // New Zealand
                '+675': 8, // Papua New Guinea
                '+676': 7, // Tonga
                '+677': 7, // Solomon Islands
                '+678': 7, // Vanuatu
                '+679': 7, // Fiji
                '+680': 7, // Palau
                '+681': 6, // Wallis and Futuna
                '+682': 5, // Cook Islands
                '+683': 4, // Niue
                '+685': 6, // Samoa
                '+686': 8, // Kiribati
                '+687': 6, // New Caledonia
                '+688': 5, // Tuvalu
                '+689': 8, // French Polynesia
                '+690': 4, // Tokelau
                '+691': 7, // Micronesia
                '+692': 7, // Marshall Islands
                '+850': 10, // North Korea
                '+853': 8, // Macau
                '+855': 9, // Cambodia
                '+856': 10, // Laos
                '+960': 7, // Maldives
                '+961': 8, // Lebanon
                '+963': 9, // Syria
                '+964': 10, // Iraq
                '+965': 8, // Kuwait
                '+966': 9, // Saudi Arabia
                '+967': 9, // Yemen
                '+968': 8, // Oman
                '+970': 9, // Palestine
                '+971': 9, // UAE
                '+972': 9, // Israel
                '+973': 8, // Bahrain
                '+974': 8, // Qatar
                '+975': 8, // Bhutan
                '+976': 8, // Mongolia
                '+977': 10, // Nepal
                '+992': 9, // Tajikistan
                '+993': 8, // Turkmenistan
                '+994': 9, // Azerbaijan
                '+995': 9, // Georgia
                '+996': 9, // Kyrgyzstan
                '+998': 9, // Uzbekistan
            }
        }
    },
    async mounted() {
        // Use hardcoded countries list to avoid API issues
        this.countries = [
            { name: 'Afghanistan', code: '+93', iso2: 'AF', iso3: 'AFG' },
            { name: 'Albania', code: '+355', iso2: 'AL', iso3: 'ALB' },
            { name: 'Algeria', code: '+213', iso2: 'DZ', iso3: 'DZA' },
            { name: 'Argentina', code: '+54', iso2: 'AR', iso3: 'ARG' },
            { name: 'Australia', code: '+61', iso2: 'AU', iso3: 'AUS' },
            { name: 'Austria', code: '+43', iso2: 'AT', iso3: 'AUT' },
            { name: 'Bangladesh', code: '+880', iso2: 'BD', iso3: 'BGD' },
            { name: 'Belgium', code: '+32', iso2: 'BE', iso3: 'BEL' },
            { name: 'Brazil', code: '+55', iso2: 'BR', iso3: 'BRA' },
            { name: 'Bulgaria', code: '+359', iso2: 'BG', iso3: 'BGR' },
            { name: 'Cambodia', code: '+855', iso2: 'KH', iso3: 'KHM' },
            { name: 'Canada', code: '+1', iso2: 'CA', iso3: 'CAN' },
            { name: 'Chile', code: '+56', iso2: 'CL', iso3: 'CHL' },
            { name: 'China', code: '+86', iso2: 'CN', iso3: 'CHN' },
            { name: 'Colombia', code: '+57', iso2: 'CO', iso3: 'COL' },
            { name: 'Croatia', code: '+385', iso2: 'HR', iso3: 'HRV' },
            { name: 'Czech Republic', code: '+420', iso2: 'CZ', iso3: 'CZE' },
            { name: 'Denmark', code: '+45', iso2: 'DK', iso3: 'DNK' },
            { name: 'Egypt', code: '+20', iso2: 'EG', iso3: 'EGY' },
            { name: 'Estonia', code: '+372', iso2: 'EE', iso3: 'EST' },
            { name: 'Finland', code: '+358', iso2: 'FI', iso3: 'FIN' },
            { name: 'France', code: '+33', iso2: 'FR', iso3: 'FRA' },
            { name: 'Germany', code: '+49', iso2: 'DE', iso3: 'DEU' },
            { name: 'Greece', code: '+30', iso2: 'GR', iso3: 'GRC' },
            { name: 'Hong Kong', code: '+852', iso2: 'HK', iso3: 'HKG' },
            { name: 'Hungary', code: '+36', iso2: 'HU', iso3: 'HUN' },
            { name: 'Iceland', code: '+354', iso2: 'IS', iso3: 'ISL' },
            { name: 'India', code: '+91', iso2: 'IN', iso3: 'IND' },
            { name: 'Indonesia', code: '+62', iso2: 'ID', iso3: 'IDN' },
            { name: 'Iran', code: '+98', iso2: 'IR', iso3: 'IRN' },
            { name: 'Iraq', code: '+964', iso2: 'IQ', iso3: 'IRQ' },
            { name: 'Ireland', code: '+353', iso2: 'IE', iso3: 'IRL' },
            { name: 'Israel', code: '+972', iso2: 'IL', iso3: 'ISR' },
            { name: 'Italy', code: '+39', iso2: 'IT', iso3: 'ITA' },
            { name: 'Japan', code: '+81', iso2: 'JP', iso3: 'JPN' },
            { name: 'Jordan', code: '+962', iso2: 'JO', iso3: 'JOR' },
            { name: 'Kazakhstan', code: '+7', iso2: 'KZ', iso3: 'KAZ' },
            { name: 'Kuwait', code: '+965', iso2: 'KW', iso3: 'KWT' },
            { name: 'Latvia', code: '+371', iso2: 'LV', iso3: 'LVA' },
            { name: 'Lebanon', code: '+961', iso2: 'LB', iso3: 'LBN' },
            { name: 'Lithuania', code: '+370', iso2: 'LT', iso3: 'LTU' },
            { name: 'Luxembourg', code: '+352', iso2: 'LU', iso3: 'LUX' },
            { name: 'Malaysia', code: '+60', iso2: 'MY', iso3: 'MYS' },
            { name: 'Maldives', code: '+960', iso2: 'MV', iso3: 'MDV' },
            { name: 'Malta', code: '+356', iso2: 'MT', iso3: 'MLT' },
            { name: 'Mexico', code: '+52', iso2: 'MX', iso3: 'MEX' },
            { name: 'Monaco', code: '+377', iso2: 'MC', iso3: 'MCO' },
            { name: 'Mongolia', code: '+976', iso2: 'MN', iso3: 'MNG' },
            { name: 'Morocco', code: '+212', iso2: 'MA', iso3: 'MAR' },
            { name: 'Myanmar', code: '+95', iso2: 'MM', iso3: 'MMR' },
            { name: 'Nepal', code: '+977', iso2: 'NP', iso3: 'NPL' },
            { name: 'Netherlands', code: '+31', iso2: 'NL', iso3: 'NLD' },
            { name: 'New Zealand', code: '+64', iso2: 'NZ', iso3: 'NZL' },
            { name: 'Nigeria', code: '+234', iso2: 'NG', iso3: 'NGA' },
            { name: 'North Korea', code: '+850', iso2: 'KP', iso3: 'PRK' },
            { name: 'Norway', code: '+47', iso2: 'NO', iso3: 'NOR' },
            { name: 'Pakistan', code: '+92', iso2: 'PK', iso3: 'PAK' },
            { name: 'Philippines', code: '+63', iso2: 'PH', iso3: 'PHL' },
            { name: 'Poland', code: '+48', iso2: 'PL', iso3: 'POL' },
            { name: 'Portugal', code: '+351', iso2: 'PT', iso3: 'PRT' },
            { name: 'Qatar', code: '+974', iso2: 'QA', iso3: 'QAT' },
            { name: 'Romania', code: '+40', iso2: 'RO', iso3: 'ROU' },
            { name: 'Russia', code: '+7', iso2: 'RU', iso3: 'RUS' },
            { name: 'Saudi Arabia', code: '+966', iso2: 'SA', iso3: 'SAU' },
            { name: 'Serbia', code: '+381', iso2: 'RS', iso3: 'SRB' },
            { name: 'Singapore', code: '+65', iso2: 'SG', iso3: 'SGP' },
            { name: 'Slovakia', code: '+421', iso2: 'SK', iso3: 'SVK' },
            { name: 'Slovenia', code: '+386', iso2: 'SI', iso3: 'SVN' },
            { name: 'South Africa', code: '+27', iso2: 'ZA', iso3: 'ZAF' },
            { name: 'South Korea', code: '+82', iso2: 'KR', iso3: 'KOR' },
            { name: 'Spain', code: '+34', iso2: 'ES', iso3: 'ESP' },
            { name: 'Sri Lanka', code: '+94', iso2: 'LK', iso3: 'LKA' },
            { name: 'Sweden', code: '+46', iso2: 'SE', iso3: 'SWE' },
            { name: 'Switzerland', code: '+41', iso2: 'CH', iso3: 'CHE' },
            { name: 'Syria', code: '+963', iso2: 'SY', iso3: 'SYR' },
            { name: 'Taiwan', code: '+886', iso2: 'TW', iso3: 'TWN' },
            { name: 'Thailand', code: '+66', iso2: 'TH', iso3: 'THA' },
            { name: 'Tunisia', code: '+216', iso2: 'TN', iso3: 'TUN' },
            { name: 'Turkey', code: '+90', iso2: 'TR', iso3: 'TUR' },
            { name: 'Ukraine', code: '+380', iso2: 'UA', iso3: 'UKR' },
            { name: 'United Arab Emirates', code: '+971', iso2: 'AE', iso3: 'ARE' },
            { name: 'United Kingdom', code: '+44', iso2: 'GB', iso3: 'GBR' },
            { name: 'United States', code: '+1', iso2: 'US', iso3: 'USA' },
            { name: 'Uruguay', code: '+598', iso2: 'UY', iso3: 'URY' },
            { name: 'Venezuela', code: '+58', iso2: 'VE', iso3: 'VEN' },
            { name: 'Vietnam', code: '+84', iso2: 'VN', iso3: 'VNM' },
            { name: 'Yemen', code: '+967', iso2: 'YE', iso3: 'YEM' },
        ];


        // Set default selected country (Philippines)
        this.selectedCountry = this.countries.find(c => c.code === '+63') || this.countries[0];

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
        const mobileSearchInput = mobileSearchContainer?.querySelector('input');
        const mobilePhoneIcon = document.getElementById('mobile-phone-icon');

        // Mobile search functionality
        function toggleMobileSearch() {
            if (!mobileSearchContainer || !mobileSearchIcon || !mobilePhoneIcon) return;

            const isVisible = !mobileSearchContainer.classList.contains('hidden');

            // Toggle visibility
            mobileSearchContainer.classList.toggle('hidden');
            mobileSearchIcon.style.display = isVisible ? 'inline-block' : 'none';
            mobilePhoneIcon.style.display = isVisible ? 'inline-block' : 'none';

            if (!isVisible && mobileSearchInput) {
                mobileSearchInput.focus();
                mobileSearchInput.value = '';
            } else if (mobileSearchInput) {
                mobileSearchInput.value = '';
            }
        }

        if (mobileSearchIcon) {
            mobileSearchIcon.addEventListener('click', toggleMobileSearch);
        }

        // Close mobile search when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileSearchContainer && !mobileSearchContainer.classList.contains('hidden') &&
                !mobileSearchContainer.contains(e.target) &&
                mobileSearchIcon && !mobileSearchIcon.contains(e.target)) {
                toggleMobileSearch();
            }
        });

        // Desktop search functionality
        if (searchIcon) {
            searchIcon.addEventListener('click', () => {
                // Only trigger if we're in desktop view
                if (window.innerWidth >= 818) {
                    if (searchContainer) searchContainer.classList.add('active');
                    if (navItems) navItems.classList.add('hidden');
                    if (searchInput) searchInput.focus();
                }
            });
        }

        if (closeSearch) {
            closeSearch.addEventListener('click', () => {
                if (searchContainer) searchContainer.classList.remove('active');
                if (navItems) navItems.classList.remove('hidden');
                if (searchInput) searchInput.value = '';
            });
        }

        // Close desktop search when clicking outside
        document.addEventListener('click', (e) => {
            if (!searchContainer || !searchIcon) return;

            const isClickInsideSearch = searchContainer.contains(e.target);
            const isClickOnSearchIcon = searchIcon.contains(e.target);

            // Check if desktop nav is visible and the click is outside the search container and icon
            if (window.innerWidth >= 818 && !isClickInsideSearch && !isClickOnSearchIcon) {
                searchContainer.classList.remove('active');
                if (navItems) navItems.classList.remove('hidden');
                if (searchInput) searchInput.value = '';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', this.handleClickOutside);

        // Function to check if mobile nav is visible
        function isMobileNavVisible() {
            return window.getComputedStyle(mobileNav).display !== 'none';
        }

        // Function to close menu
        function closeMenu() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = 'auto'; // Enable scrolling when menu is closed
        }

        mobileMenuButton.addEventListener('click', () => {
            const isMenuActive = mobileMenu.classList.contains('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = isMenuActive ? 'auto' : 'hidden'; // Toggle overflow based on menu state
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
        // Add new methods for capitalization
        capitalizeFirstLetter(value) {
            if (!value) return value;
            return value.charAt(0).toUpperCase() + value.slice(1);
        },

        handleFullNameInput(event) {
            // Remove any character that is not a letter or space
            let value = event.target.value.replace(/[^A-Za-z ]+/g, '');
            this.formData.full_name = this.capitalizeFirstLetter(value);
        },

        handleMessageInput(event) {
            this.formData.message = this.capitalizeFirstLetter(event.target.value);
        },

        getPhoneLength(countryCode) {
            return this.phoneLengthMap[countryCode] || 12;
        },

        getCountryFlag(iso2) {
            if (!iso2) return '';
            // Convert ISO2 country code to flag emoji
            const codePoints = iso2
                .toUpperCase()
                .split('')
                .map(char => 127397 + char.charCodeAt());
            return String.fromCodePoint(...codePoints);
        },

        toggleCountryDropdown() {
            this.showCountryDropdown = !this.showCountryDropdown;
        },

        selectCountry(country) {
            this.selectedCountry = country;
            this.formData.country_code = country.code;
            this.showCountryDropdown = false;
        },

        // Close dropdown when clicking outside
        handleClickOutside(event) {
            const dropdown = event.target.closest('.relative');
            if (!dropdown && this.showCountryDropdown) {
                this.showCountryDropdown = false;
            }
        },

        async submitInquiry() {
            try {
                this.isSubmitting = true;
                this.errorMessage = null;

                // Get expected phone length for selected country
                const expectedLength = this.getPhoneLength(this.formData.country_code);

                // Custom validation for contact_number (numbers only and correct length)
                if (!/^[0-9]+$/.test(this.formData.contact_number)) {
                    this.errorMessage = 'Contact number must contain numbers only.';
                    this.isSubmitting = false;
                    return;
                }

                if (this.formData.contact_number.length !== expectedLength) {
                    this.errorMessage = `Contact number for ${this.formData.country_code} must be ${expectedLength} digits.`;
                    this.isSubmitting = false;
                    return;
                }

                // Stricter email validation: must be in the format name@domain.com, domain must be gmail, yahoo, outlook, hotmail, or similar
                const emailPattern = /^[A-Za-z0-9._%+-]+@(gmail|yahoo|outlook|hotmail|icloud|protonmail|zoho|aol|mail|gmx|yandex)\.[A-Za-z]{2,}$/i;
                if (!emailPattern.test(this.formData.email)) {
                    this.errorMessage = 'Please enter a valid email address (e.g., name@gmail.com, name@yahoo.com).';
                    this.isSubmitting = false;
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!csrfToken) {
                    throw new Error('CSRF token not found. Please refresh the page and try again.');
                }

                const response = await fetch('/inquiry', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(this.formData)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to submit inquiry');
                }

                // Success SweetAlert
                await Swal.fire({
                    icon: 'success',
                    title: 'Thank You!',
                    text: 'Inquiry submitted successfully!',
                    background: '#f0fff0',
                    confirmButtonColor: '#2E7D32',
                    customClass: {
                        confirmButton: 'swal2-confirm-green'
                    }
                });

                // Reset form
                this.formData = {
                    full_name: '',
                    country_code: '+63',
                    contact_number: '',
                    email: '',
                    message: ''
                };
            } catch (error) {
                console.error('Error:', error);
                this.errorMessage = error.message || 'There was an error submitting your inquiry. Please try again.';
                // Error SweetAlert
                await Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: this.errorMessage,
                    confirmButtonColor: '#2E7D32',
                    background: '#fff',
                    customClass: {
                        confirmButton: 'swal2-confirm-green'
                    }
                });
            } finally {
                this.isSubmitting = false;
            }
        },
        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                // Close mobile menu if it's open
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = 'auto'; // Enable scrolling when menu is closed
                }

                // Add offset for PRODUCTS section only on small mobile screens
                let offset = 0;
                if (sectionId === 'products') {
                    if (window.innerWidth <= 480) {
                        offset = 100; // Only apply offset on mobile <= 480px
                    }
                }

                // Get the section's position relative to the viewport
                const sectionTop = section.getBoundingClientRect().top + window.pageYOffset - offset;

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