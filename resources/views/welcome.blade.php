<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Chatbot button styles */
        .chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #2E7D32;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 100;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease;
            position: fixed;
            overflow: visible;
        }

        .chatbot-button::before {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #1B5E20; /* Dark green border */
            box-shadow: 0 0 4px 4px #1B5E20AA; /* Dark green glow */
            opacity: 0.7;
            z-index: -1;
            background: transparent;
            animation: chatbot-ring-pulse 2.2s cubic-bezier(0.1, 0.1, 0.1, 0.1) infinite;
        }

        @keyframes chatbot-ring-pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.7;
                box-shadow: 0 0 16px 4px #1B5E20AA;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.4;
                box-shadow: 0 0 28px 10px #1B5E2077;
            }
            80% {
                transform: translate(-50%, -50%) scale(1.35);
                opacity: 0.15;
                box-shadow: 0 0 36px 16px #1B5E2033;
            }
            100% {
                transform: translate(-50%, -50%) scale(1.45);
                opacity: 0;
                box-shadow: 0 0 44px 22px #1B5E2000;
            }
        }

        @media (max-width: 768px) {
            .chatbot-button {
                width: 50px;
                height: 50px;
                font-size: 20px;
                bottom: 15px;
                right: 15px;
            }
            .chatbot-button::before {
                width: 65px;
                height: 65px;
                border-width: 2px;
            }
        }

        .chatbot-button:hover {
            transform: scale(1.1);
            background-color: #388E3C;
        }

        .chatbot-button.active {
            transform: rotate(45deg);
        }

        .chatbot-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out;
        }

        .chatbot-button:hover .chatbot-image {
            transform: scale(1.05);
        }

        .chatbot-button.active .chatbot-image {
            transform: rotate(-45deg);
        }

        /* Chatbot modal styles */
        .chat-modal {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            height: 450px;
            background-color: #FDFDFC;
            border-radius: 12px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            flex-direction: column;
            overflow: hidden;
            animation: fadeIn 0.3s ease-out;
        }

        @media (max-width: 768px) {
            .chat-modal {
                width: 300px;
                height: 350px;
                bottom: 80px;
                right: 15px;
                left: auto;
                max-width: 300px;
                max-height: 80vh;
            }

            .chat-modal-header {
                padding: 12px 15px;
            }

            .chat-modal-header h4 {
                font-size: 16px;
            }

            .chat-modal-body {
                padding: 12px;
            }

            .chat-modal-footer {
                padding: 12px 15px;
            }

            .chat-modal-footer input[type="text"] {
                padding: 8px 12px;
                font-size: 14px;
            }

            .chat-modal-footer button {
                padding: 8px 12px;
                font-size: 14px;
            }

            .chat-modal-body .message {
                padding: 8px 12px;
                font-size: 14px;
                max-width: 85%;
            }
        }

        @media (max-width: 480px) {
            .chat-modal {
                width: 280px;
                height: 320px;
                bottom: 70px;
                right: 10px;
                left: auto;
                max-width: 280px;
                max-height: 80vh;
            }

            .chat-modal-footer {
                flex-wrap: wrap; /* Re-enabled to allow items to wrap on small screens */
                gap: 5px; /* Re-enabled for spacing when wrapped */
            }

            .chat-modal-footer input[type="text"] {
                width: calc(100% - 99px); /* Adjusted width to leave space for two buttons */
                flex-grow: 0; /* Prevent it from taking too much space */
            }

            .chat-modal-footer button {
                width: 35px;
                height: 35px;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .chat-modal.active {
            display: flex;
        }

        .chat-modal-header {
            background: linear-gradient(to right, #2E7D32, #388E3C); /* Gradient header */
            color: white;
            padding: 15px 20px; /* Increased padding */
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-modal-header h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .chat-modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 20px; /* Adjusted size */
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .chat-modal-close:hover {
            transform: scale(1.2);
        }

        .chat-modal-body {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #e9e9e9;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .chat-modal-body .message {
            background-color: #dcf8c6;
            padding: 10px 15px; /* Adjusted padding */
            border-radius: 18px; /* More rounded bubbles */
            margin-bottom: 5px; /* Reduced margin */
            max-width: 80%;
            align-self: flex-end;
            word-wrap: break-word;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .chat-modal-body .message.received {
            background-color: #f1f0f0;
            align-self: flex-start;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* FAQ buttons styles - moved to footer area */
        .faq-section {
            background-color: transparent;
            padding: 10px 10px;
            width: 100%;
        }

        .faq-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            padding: 0 15px;
        }

        .faq-button {
            background-color: #dcf8c6;
            color: black;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
            padding: 10px 10px;
            border-radius: 20px;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
            max-width: 280px;
            position: relative;
            overflow: hidden;
        }

        .faq-button:hover {
            background-color: #A5D6A7;
            transform: translateY(-1px);
        }

        .faq-button:active {
            transform: translateY(0);
        }

        .faq-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            border-color: #999;
            color: #666;
        }

        @media (max-width: 768px) {
            .faq-section {
                padding: 8px;
            }

            .faq-buttons {
                padding: 0 10px;
            }

            .faq-button {
                padding: 8px 14px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .faq-section {
                padding: 6px;
            }

            .faq-buttons {
                padding: 0 8px;
            }

            .faq-button {
                padding: 8px 12px;
                font-size: 12px;
                max-width: 240px;
            }
        }

        .chat-modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            gap: 10px;
            flex-wrap: wrap; /* Allow items to wrap on small screens */
        }

        .chat-modal-footer input[type="text"] {
            flex: 1;
            min-width: 120px; /* Minimum width to ensure some text is visible */
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s ease;
            text-transform: capitalize; /* Capitalize first letter */
        }

        @media (max-width: 480px) {
            .chat-modal-footer {
                padding: 10px;
                gap: 8px;
            }

            .chat-modal-footer input[type="text"] {
                width: 100%; /* Take full width on very small screens */
                font-size: 13px; /* Slightly smaller font for mobile */
                padding: 8px 12px; /* Slightly reduced padding */
            }

            .chat-modal-footer button {
                padding: 8px 12px;
                font-size: 13px;
            }
        }

        .chat-modal-footer button {
            background-color: #2E7D32;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px; /* Pill shape */
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-modal-footer button:hover {
            background-color: #388E3C;
        }

        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 2px;
            height: 24px;
            margin-bottom: 2px;
        }
        .typing-dot {
            width: 8px;
            height: 8px;
            background: #bdbdbd;
            border-radius: 50%;
            display: inline-block;
            animation: typingWave 1s infinite;
        }
        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typingWave {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.7;
            }
            30% {
                transform: translateY(-7px);
                opacity: 1;
            }
        }
        .chatbot-scroll-link:hover {
            color: #1B5E20 !important; /* Darker green on hover */
        }
    </style>

    <!-- Main styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased">
    <div id="app"></div>

    <button id="chatbot-button" class="chatbot-button">
        <img src="{{ asset('images/pandoy cut 1.png') }}" alt="Chatbot" class="chatbot-image">
    </button>

    <div id="chat-modal" class="chat-modal">
        <div class="chat-modal-header">
            <h4>Pandoy Chat</h4>
            <button class="chat-modal-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="chat-modal-body">
            <!-- Chat messages will go here -->
            <p class="message received">Good day! I'm Pandoy Thank you for reaching Leads Agricultural Products Corporation. For security purposes and to serve you better, kindly confirm if you agree to have this conversation recorded.</p>
            <div class="faq-section" id="faq-section">
                <div class="faq-buttons" id="faq-buttons"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotButton = document.getElementById('chatbot-button');
            const chatModal = document.getElementById('chat-modal');
            const closeModalButton = document.querySelector('.chat-modal-close');
            const chatBody = document.querySelector('.chat-modal-body');
            const faqButtonsContainer = document.getElementById('faq-buttons');
            const faqSection = document.getElementById('faq-section');

            // FAQ data mapping
            const faqData = {
                'Products & Services': 'Thank you for your interest in our products and services. You may know more about these link <a href="#" onclick="scrollToSection(\'products\'); return false;" class="chatbot-scroll-link" style="color:#22AA4A;text-decoration:underline;">Products & Services</a>.',
                'Latest News ': 'Thank you for your interest in our latest news. You may know more about these through this link <a href="#" onclick="scrollToSection(\'news\'); return false;" class="chatbot-scroll-link" style="color:#22AA4A;text-decoration:underline;">Latest News</a>.',
                'Contact Details': 'You may reach us via by directly contacting our customer service via +63 917 7726369 or contacting us via facebook.com/leadsagri. Alternatively, you may send us a message through this link <a href="#" onclick="scrollToSection(\'contact\'); return false;" class="chatbot-scroll-link" style="color:#22AA4A;text-decoration:underline;">Contact Details</a>.',
                'Careers': 'Thank you for your interest in our current openings. You may know more about these through this link <a href="#" onclick="scrollToSection(\'careers\'); return false;" class="chatbot-scroll-link" style="color:#22AA4A;text-decoration:underline;">Careers</a>.',
            };

            let confirmed = false;

            function showTypingIndicator() {
                const indicator = document.createElement('div');
                indicator.id = 'typing-indicator';
                indicator.classList.add('message', 'received');
                indicator.style.backgroundColor = 'transparent';
                indicator.style.boxShadow = 'none';
                indicator.innerHTML = `
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                `;
                chatBody.insertBefore(indicator, faqSection);
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            function hideTypingIndicator() {
                const indicator = document.getElementById('typing-indicator');
                if (indicator) {
                    indicator.remove();
                }
            }

            // Function to add a message to the chat
            function addMessage(content, isReceived = false) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                if (isReceived) {
                    messageElement.classList.add('received');
                    messageElement.innerHTML = content;
                } else {
                    messageElement.textContent = content;
                }
                // Insert the message before the FAQ section so buttons stay at the bottom
                chatBody.insertBefore(messageElement, faqSection);
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            // Show Yes/No confirmation buttons initially
            function showConfirmationButtons() {
                faqButtonsContainer.innerHTML = '';
                const yesBtn = document.createElement('button');
                yesBtn.className = 'faq-button';
                yesBtn.textContent = 'Yes, I agree.';
                yesBtn.onclick = function() {
                    confirmed = true;
                    showFAQButtons();
                    addMessage('Thank you very much! How can we help you today?', true);
                };
                const noBtn = document.createElement('button');
                noBtn.className = 'faq-button';
                noBtn.textContent = 'No.';
                noBtn.onclick = function() {
                    confirmed = false;
                    showDisabledFAQButtons();
                    addMessage('Thank you very much. Have a great day!', true);
                };
                faqButtonsContainer.appendChild(yesBtn);
                faqButtonsContainer.appendChild(noBtn);
            }

            // Show FAQ buttons after confirmation
            function showFAQButtons() {
                faqButtonsContainer.innerHTML = '';
                Object.keys(faqData).forEach(key => {
                    const btn = document.createElement('button');
                    btn.className = 'faq-button';
                    btn.textContent = key;
                    btn.onclick = function() {
                        addMessage(key);
                        faqButtonsContainer.innerHTML = ''; // Clear buttons

                        showTypingIndicator();

                        // Simulate bot response delay
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage(faqData[key], true);
                            showMainMenuButton();
                        }, 1200);
                    };
                    faqButtonsContainer.appendChild(btn);
                });
            }

            // Show a Main Menu button after a FAQ answer
            function showMainMenuButton() {
                faqButtonsContainer.innerHTML = '';
                const mainMenuBtn = document.createElement('button');
                mainMenuBtn.className = 'faq-button';
                mainMenuBtn.textContent = 'Main Menu';
                mainMenuBtn.onclick = showFAQButtons;
                faqButtonsContainer.appendChild(mainMenuBtn);

                const endBtn = document.createElement('button');
                endBtn.className = 'faq-button';
                endBtn.textContent = 'End of Conversation';
                endBtn.onclick = function() {
                    showDisabledFAQButtons();
                    addMessage('Thank you very much. Have a great day!', true);
                };
                faqButtonsContainer.appendChild(endBtn);
            }

            // When conversation ends (after No), only show End of Conversation message, no FAQ buttons
            function showDisabledFAQButtons() {
                faqButtonsContainer.innerHTML = '';

                // Continue button only
                const continueBtn = document.createElement('button');
                continueBtn.className = 'faq-button';
                continueBtn.textContent = 'Continue';
                continueBtn.onclick = function() {
                    addMessage("Good day! I'm Pandoy Thank you for reaching Leads Agricultural Products Corporation. For security purposes and to serve you better, kindly confirm if you agree to have this conversation recorded.", true);
                    showConfirmationButtons();
                };
                faqButtonsContainer.appendChild(continueBtn);
            }

            chatbotButton.onclick = function() {
                chatModal.classList.toggle('active');
                chatbotButton.classList.toggle('active');
            };
            closeModalButton.onclick = function() {
                chatModal.classList.remove('active');
                chatbotButton.classList.remove('active');
            };

            showConfirmationButtons();
        });
    </script>
</body>

</html>