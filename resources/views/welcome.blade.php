<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LeadsAgri</title>
    
    <!-- Styles -->
    <style>
        /* Font Awesome - Must be first */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

        /* Font definitions */
        @font-face {
            font-family: 'Helvetica Neue LT Std';
            src: url('https://db.onlinewebfonts.com/c/66e796dac9aff5a6967ebdd5e021db01?family=HelveticaNeueLTStd-Roman') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        
        @font-face {
            font-family: 'Helvetica Neue LT Std';
            src: url('https://db.onlinewebfonts.com/c/66e796dac9aff5a6967ebdd5e021db01?family=HelveticaNeueLTStd-Medium') format('woff2');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }
        
        @font-face {
            font-family: 'Helvetica Neue LT Std';
            src: url('https://db.onlinewebfonts.com/c/66e796dac9aff5a6967ebdd5e021db01?family=HelveticaNeueLTStd-Bold') format('woff2');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        .nav-link {
            font-family: 'Helvetica Neue LT Std', sans-serif;
            position: relative;
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            transform: scale(1.1);
        }

        .nav-link::after {
            display: none;
        }

        .section {
            min-height: 100vh;
            padding: 80px 0;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Mobile menu styles */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .mobile-menu-icons {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 2rem;
        }

        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-menu-link {
            text-align: left;
            /* <- changed from center */
            width: 100%;
        }

        @media (max-width:  818px) {
            .desktop-nav {
                display: none;
            }

            .mobile-nav {
                display: block;
            }
        }

        @media (min-width:  818px) {
            .mobile-nav {
                display: none;
            }

            .desktop-nav {
                display: flex;
            }
        }

        /* Navigation spacing */
        .nav-spacing {
            margin: 0 2rem;
        }

        .nav-icon {
            margin: 0 1.5rem;
        }

        @media (max-width: 1024px) {
            .nav-spacing {
                margin: 0 1rem;
            }

            .nav-icon {
                margin: 0 1rem;
            }
        }

        /* Add search bar styles */
        .search-container {
            display: none;
            width: 50%;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: transparent;
            padding: 1rem 1rem;
            margin-top: 1.5rem;
            z-index: 51;
        }

        .search-container.active {
            display: flex;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 2px solid #2E7D32;
            border-radius: 4px;
            font-size: 1rem;
            outline: none;
            background: transparent;
            color: #2E7D32;
            padding-right: 2.5rem;
        }

        .search-input::placeholder {
            color: #2E7D32;
            opacity: 0.7;
        }

        #close-search {
            position: absolute;
            right: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .nav-items {
            transition: opacity 0.3s ease;
        }

        .nav-items.hidden {
            opacity: 0;
            pointer-events: none;
        }
        @media (max-width: 817px) {
        #search-container {
            display: none !important;
        }
        #search-icon {
            display: none !important;
        }
    }
    </style>
    
    <!-- Main styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased">
    <div id="app"></div>
</body>

</html>
