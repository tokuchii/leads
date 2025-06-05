<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeadsAgri</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @import url(https://db.onlinewebfonts.com/c/66e796dac9aff5a6967ebdd5e021db01?family=HelveticaNeueLTStd-Roman);
            .nav-link {
                font-family: 'Helvetica Neue LT Std', sans-serif;
                position: relative;
                font-weight: 600;
            }
            .nav-link::after {
                content: '...';
                position: absolute;
                bottom: -4px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 12px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .nav-link:hover::after {
                opacity: 1;
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
            <nav class="container mx-auto px-6 py-6 fixed top-0 left-0 right-0 z-50 bg-transparent">
                <div class="flex items-center justify-between">
              
                  <!-- Left Section -->
                  <div class="flex items-center space-x-25 ">
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition">
                      <i class="fas fa-search text-lg"></i>
                    </a>
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition text-lg font-bold">ABOUT US</a>
                  </div>
              
                  <!-- Center Section -->
                  <div class="flex items-center space-x-50 text-lg ">
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition font-bold">PRODUCTS</a>
                    <span class="text-2xl font-bold text-white">LeadsAgri</span>
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition font-bold">NEWS</a>
                  </div>
              
                  <!-- Right Section -->
                  <div class="flex items-center space-x-25 ">
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition text-lg font-bold">CAREERS</a>
                    <a href="#" class="nav-link text-white hover:text-[#4CAF50] transition">
                      <i class="fas fa-phone text-lg"></i>
                    </a>
                  </div>
              
                </div>
            </nav>

            <!-- Vue App Mount Point -->
            <div id="app"></div>
        </div>
    </body>
</html>
