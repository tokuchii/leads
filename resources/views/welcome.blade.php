<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeadsAgri</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            @import url(https://db.onlinewebfonts.com/c/66e796dac9aff5a6967ebdd5e021db01?family=HelveticaNeueLTStd-Roman);
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
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
        <div class="min-h-screen">
            <!-- Navigation -->
            <div class="fixed top-0 left-0 right-0 z-50">
                <!-- White fade gradient effect -->
                <div class="h-20 bg-gradient-to-b from-white via-white/60 to-transparent"></div>
                <!-- Navigation content -->
                <nav class="container mx-auto px-6 py-6 absolute top-0 left-0 right-0">
                    <div class="flex items-center justify-between">
                        <!-- Left Section -->
                        <div class="flex items-center space-x-35">
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition">
                                <i class="fas fa-search text-lg"></i>
                            </a>
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition text-lg">ABOUT US</a>
                        </div>

                        <!-- Center Section -->
                        <div class="flex items-center space-x-50 text-lg">
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition">PRODUCTS</a>
                            <span class="text-2xl font-bold text-[#4CAF50] dark:text-[#4CAF50] transition">LeadsAgri</span>
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition">NEWS</a>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-35">
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition text-lg">CAREERS</a>
                            <a href="#" class="nav-link text-[#4CAF50] dark:text-[#4CAF50] transition">
                                <i class="fas fa-phone text-lg"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Vue App Mount Point -->
            <div id="app" class="pt-0">
                <!-- Content will be loaded by Vue -->
                <p class="text-center text-xl text-gray-500">Loading application...</p>
            </div>
        </div>
    </body>
</html>
