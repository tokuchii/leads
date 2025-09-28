<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Leads Agri</title>
    <link rel="icon" type="image/png" href="{{ asset('/images/logo-green.png') }}">

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
            /* Removed text-transform: capitalize; to allow normal typing */
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

        /* Main Menu Button Styles */
        .main-menu-btn {
            background-color: #2E7D32;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: block;
            width: 100%;
            text-decoration: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .main-menu-btn:hover {
            background-color: #388E3C;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .main-menu-btn:active {
            transform: translateY(0);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
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
            <h4>PandoyBot</h4>
            <button class="chat-modal-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="chat-modal-body">
            <!-- Chat messages will go here -->
            <div class="faq-section" id="faq-section">
                <div class="faq-buttons" id="faq-buttons"></div>
            </div>
        </div>
        <form id="chat-modal-footer" class="chat-modal-footer" style="display:none;">
            <input type="text" id="chat-input" placeholder="Type your message..." autocomplete="off" />
            <button type="submit" id="send-btn"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>

    <script>
        // Global variables
        let conversationEnded = false;
        let currentMenu = 'main'; // 'main' or 'product-info'
        let chatGreeted = false;
        let chatInput, sendBtn, chatBody, faqSection;

        // Function to go back to main menu (global scope)
        function goToMainMenu() {
            currentMenu = 'main';
            showTypingIndicator();
            setTimeout(() => {
                hideTypingIndicator();
                addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matutulungan ka!", true);
                chatInput.disabled = false;
                sendBtn.disabled = false;
                chatInput.focus();
            }, 400);
        }

        // Function to go to contacts (global scope)
        function goToContacts() {
    const chatModal = document.getElementById('chat-modal');
    const chatbotButton = document.getElementById('chatbot-button');

    chatModal?.classList.remove('active');
    chatbotButton?.classList.remove('active');

    setTimeout(() => {
        const contactSection = document.getElementById("contact");
        if (contactSection) {
            contactSection.scrollIntoView({ behavior: "smooth" });
        }
    }, 300);
}


        function showTypingIndicator() {
            const indicator = document.createElement('div');
            indicator.id = 'typing-indicator';
            indicator.classList.add('message', 'received');
            indicator.style.backgroundColor = '#f1f0f0';
            indicator.style.boxShadow = '0px 1px 2px rgba(0,0,0,0.1)';
            indicator.style.borderRadius = '18px';
            indicator.style.padding = '10px 15px';
            indicator.style.marginBottom = '5px';
            indicator.style.maxWidth = '80%';
            indicator.style.alignSelf = 'flex-start';
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

        document.addEventListener('DOMContentLoaded', function() {
            const chatbotButton = document.getElementById('chatbot-button');
            const chatModal = document.getElementById('chat-modal');
            const closeModalButton = document.querySelector('.chat-modal-close');
            chatBody = document.querySelector('.chat-modal-body');
            const faqButtonsContainer = document.getElementById('faq-buttons');
            faqSection = document.getElementById('faq-section');
            const chatFooter = document.getElementById('chat-modal-footer');
            chatInput = document.getElementById('chat-input');
            sendBtn = document.getElementById('send-btn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Show AI chat input immediately
            function showAIChat() {
                faqButtonsContainer.innerHTML = '';
                chatFooter.style.display = 'flex';
                chatInput.value = '';
                chatInput.disabled = false;
                sendBtn.disabled = false;
                chatInput.focus();
            }

            // When conversation ends, only show Continue button
            function showDisabledFAQButtons() {
                chatFooter.style.display = 'none';
                faqButtonsContainer.innerHTML = '';
                const continueBtn = document.createElement('button');
                continueBtn.className = 'faq-button';
                continueBtn.textContent = 'Continue';
                continueBtn.onclick = function() {
                    addMessage("👋 Hello Ka-Leads! Ako si PandoyBot, ang digital farm buddy mo mula sa Leads Agri! May katanungan ka ba? Message ka lang!🌾", true);
                    showAIChat();
                    conversationEnded = false;
                    setTimeout(() => {
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matulungan ka!", true);
                        }, 1000);
                    }, 2000);
                };
                faqButtonsContainer.appendChild(continueBtn);
            }

            // Handle chat form submit
            chatFooter.addEventListener('submit', function(e) {
                e.preventDefault();
                if (conversationEnded) return;
                const userMsg = chatInput.value.trim();
                if (!userMsg) return;
                addMessage(userMsg, false);
                chatInput.value = '';
                chatInput.disabled = true;
                sendBtn.disabled = true;

                // Always show main menu if user types 'menu', even if already in main menu
                if (userMsg.toLowerCase() === 'menu') {
                    currentMenu = 'main';
                    showTypingIndicator();
                    setTimeout(() => {
                        hideTypingIndicator();
                        addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matulungan ka!", true);
                        chatInput.disabled = false;
                        sendBtn.disabled = false;
                        chatInput.focus();
                    }, 1000);
                    return;
                }

                // Guard clause: Prevent fetch for invalid main menu input
                if (currentMenu === 'main' && !['1', '2', '3'].includes(userMsg)) {
                    console.log('Invalid input at main menu, blocking fetch.'); // Debug log
                    showTypingIndicator();
                    setTimeout(() => {
                        hideTypingIndicator();
                        addMessage('🤔 Uy, hindi ko masyadong na-gets ‘yan, Ka-Leads.<br><br>Type “Menu” para bumalik sa main options o subukang i-type muli ang iyong katanungan.', true);
                        chatInput.disabled = false;
                        sendBtn.disabled = false;
                        chatInput.focus();
                    }, 400);
                    return;
                }

                // Handle going back to main menu
                if (currentMenu === 'product-info' && (userMsg.toLowerCase() === 'menu')) {
                    currentMenu = 'main';
                    showTypingIndicator();
                    setTimeout(() => {
                        hideTypingIndicator();
                        addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matutulungan ka!", true);
                        hideTypingIndicator();
                        addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matutulungan ka!", true);
                        chatInput.disabled = false;
                        sendBtn.disabled = false;
                        chatInput.focus();
                    }, 400);
                    return;
                }

                // Main menu logic
                if (currentMenu === 'main') {
                    if (userMsg === '1') {
                        currentMenu = 'product-info';
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage('Product Info📦<br><br>Anong klaseng produkto ang gusto mong makita? I-type lang ang number o product name na nais makita (hal. Jackpot, Starkle, etc.) at hintayin itong lumabas sa chat box!<br><br>1️⃣ Insecticides 🐛<br>2️⃣ Herbicides 🌿<br>3️⃣ Fungicides 🍄<br>4️⃣ Fertilizers 💧<br>5️⃣ Molluscicides 🐌', true);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }
                    if (userMsg === '2') {
                        currentMenu = 'technical-support';
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage('Technical Support👨‍🌾<br><br>Anong klaseng assistance ang kailangan mo, Ka-LEADS?<br><br>Halimaba na pwedeng mga itanong:<br>- Paggamit ng produkto <br>- Peste o sakit sa palay  <br>- Schedule ng abono o spray  <br><br>I-type lang ang concern mo (hal. “Anong solusyon sa brown planthopper?” or “Kailan i-spray ang Frontier?”) at tutulungan ka ng aming customer service support sa iyong concern!', true);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }
                    if (userMsg === '3') {
                        currentMenu = 'leads-expert';
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage('Talk to a Ka-Leads Expert☎️ <br><br>📞 Gusto mo bang makausap ang isang Leads Agri Technician o Sales Officer? <br>Pakisend lang ang: <br>✅ Pangalan mo <br>✅ Lokasyon mo <br>✅ Concern or tanong <br><br>I-coconnect kita agad, Ka-LEADS! <br><br><button class="main-menu-btn" onclick="goToContacts()">Go to Contacts</button>', true);
                            // Add separate message for menu options
                            setTimeout(() => {
                                addMessage('Type "MENU" o pindutin ang MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>', true);
                            }, 100);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }
                }

                // Product info logic
                if (currentMenu === 'product-info') {
                    // Product name to info mapping
                    const productInfoMap = [
                        { name: 'Brofreya 20 SC', info: '<b>Brofreya 20 SC</b><br><br>A systemic insecticide that controls insect pests in rice and vegetable crops.' },
                        { name: 'Pleo 10 EC', info: '<b>Pleo 10 EC</b><br><br>A contact and stomach insecticide with novel chemical structure for the control of insect pests of cabbage and tobacco.' },
                        { name: 'Rimon 10 EC', info: '<b>Rimon 10 EC</b><br><br>An insect growth regulator, which acts as chitin inhibitor, thereby causing abnormal endocuticular deposition and abortive molting.' },
                        { name: 'Aztron WDG', info: '<b>Aztron WDG</b><br><br>A biological insecticide intended for the control of worms (insect larvae).' },
                        { name: 'Benefit 20 SC', info: '<b>Benefit 20 SC</b><br><br>A systemic insecticide that controls insect pests in rice and vegetable crops.' },
                        { name: 'Starkle 20 SG', info: '<b>Starkle 20 SG</b><br><br>An organic fungicide that targets black sigatoka on vegetable crops.' },
                        { name: 'Lancer Gold 55 WG', info: '<b>Lancer Gold 55 WG</b><br><br>An organic fungicide that targets black sigatoka on vegetable crops.' },
                        { name: 'Frontier 200 OD', info: '<b>Frontier 200 OD</b><br><br>A post-emergent herbicide that targets weeds in rice plant to avoid crop-weed competition.' },
                        { name: 'Frontier MAX', info: '<b>Frontier MAX</b><br><br>A herbicide with the mixed efficiency of Frontier 200 OD and Leads Exit.' },
                        { name: 'Mower 48 SL', info: '<b>Mower 48 SL</b><br><br>A post-emergent general foliar weed killer that controls the growth of weeds in various crops.' },
                        { name: 'Agil 100 EC', info: '<b>Agil 100 EC</b><br><br>This herbicide can avoid the growth of weeds in onions.' },
                        { name: 'Mower Ultra 514 SL', info: '<b>Mower Ultra 514 SL</b><br><br>A post-emergent general foliar weed killer that controls the growth of weeds in Glyphosate-tolerant corn.' },
                        { name: 'Top Ace 80 SC', info: '<b>Top Ace 80 SC</b><br><br>A systemic herbicide with Diuron that targets weeds.' },
                        { name: 'Top Ace MAX', info: '<b>Top Ace MAX</b><br><br>A herbicide with the mixed efficiency of Top Ace 80 SC and Leads Exit.' },
                        { name: 'Karmex Gold', info: '<b>Karmex Gold</b><br><br>A highly systemic herbicide against weeds on various crops.' },
                        { name: 'Ignite 15 SL', info: '<b>Ignite 15 SL</b><br><br>Non-selective herbicide with Glufosinate Ammonium that targets weeds.' },
                        { name: 'STK Regev', info: '<b>STK Regev</b><br><br>The first hybrid fungicide in the country: it has the joint efficacy of systemic fungicide and tea tree oil that controls diseases on crops.' },
                        { name: 'Timorex Gold', info: '<b>Timorex Gold</b><br><br>With its tea tree oil ingredient, Timorex Gold has the power to defend and heal planted vegetable crops against black sigatoka and other diseases.' },
                        { name: 'Domark Pro', info: '<b>Domark Pro</b><br><br>A systemic fungicide that targets anthracnose and stem-end rot in mango trees.' },
                        { name: 'Manager 80 WP', info: '<b>Manager 80 WP</b><br><br>Its active ingredient, Mancozeb, helps in giving crops a long-lasting resistance against fungus. It also has zinc and manganese for added protection.' },
                        { name: 'Armore 70 WP', info: '<b>Armore 70 WP</b><br><br>Being a systemic fungicide, Armor 70 WP seeps through the roots of the plant for longer effectivity.' },
                        { name: 'Leadonil 500 SC', info: '<b>Leadonil 500 SC</b><br><br>A broad spectrum agricultural fungicide effective against a wide range of diseases in field, fruit and vegetable crops.' },
                        { name: 'iSmart Ceres', info: '<b>iSmart Ceres</b><br><br>A biostimulant that helps in the growth of crops, while also avoiding transplanting shock and abiotic stress due to extreme heat, flooding, and drought.' },
                        { name: 'iSmart Boom Flower-n', info: '<b>iSmart Boom Flower-n</b><br><br>iSmart Boom Flower Improves flower initiation, improves fruit retention and assimilation, and increases fruit size, weight and quality.' },
                        { name: 'iSmart Nano Urea', info: '<b>iSmart Nano Urea</b><br><br>This fertilizer helps bring Nitrogen to the plant on a nano sized level that allows for better absorption with reduced chances of wash off.' },
                        { name: 'Kawa 422', info: '<b>Kawa 422</b><br><br>Kawa 422 is an organic fertilizer that’s a good alternative to chicken manure as it\'s more cost-effective to use, and more eco-friendly.' },
                        { name: 'MegaBooster', info: '<b>MegaBooster</b><br><br>MegaBooster is a water soluble foliar fertilizer that meets the high nutrient requirements of your crops during fruit development and ripening.' },
                        { name: 'Tecamin Max', info: '<b>Tecamin Max</b><br><br>A foliar biostimulant with amino acids that enhances qualities of vegetables by fighting abiotic stress.' },
                        { name: 'Niclos M Plus', info: '<b>Niclos M Plus</b><br><br>As a molluscicide, Niclos M Plus contains Niclosamide in wettable power formulation.' }
                    ];
                    // Category number to info mapping
                    const productCategoryResponses = {
                        '1': 'Insecticides 🐛<br><br><b>Brofreya 20 SC</b>: A systemic insecticide that controls insect pests in rice and vegetable crops.<br><b>Pleo 10 EC</b>: A contact and stomach insecticide with novel chemical structure for the control of insect pests of cabbage and tobacco.<br><b>Rimon 10 EC</b>: An insect growth regulator, which acts as chitin inhibitor, thereby causing abnormal endocuticular deposition and abortive molting.<br><b>Aztron WDG</b>: A biological insecticide intended for the control of worms (insect larvae).<br><b>Benefit 20 SC</b>: A systemic insecticide that controls insect pests in rice and vegetable crops.<br><b>Starkle 20 SG</b>: An organic fungicide that targets black sigatoka on vegetable crops.<br><b>Lancer Gold 55 WG</b>: An organic fungicide that targets black sigatoka on vegetable crops.<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>',
                        '2': 'Herbicides 🌿<br><br><b>Frontier 200 OD</b>: A post-emergent herbicide that targets weeds in rice plant to avoid crop-weed competition.<br><b>Frontier MAX</b>: A herbicide with the mixed efficiency of Frontier 200 OD and Leads Exit.<br><b>Mower 48 SL</b>: A post-emergent general foliar weed killer that controls the growth of weeds in various crops<br><b>Agil 100 EC</b>: This herbicide can avoid the growth of weeds in onions<br><b>Mower Ultra 514 SL</b>: A post-emergent general foliar weed killer that controls the growth of weeds in Glyphosate-tolerant corn<br><b>Top Ace 80 SC</b>: A systemic herbicide with Diuron that targets weeds<br><b>Top Ace MAX</b>: A herbicide with the mixed efficiency of Top Ace 80 SC and Leads Exit.<br><b>Karmex Gold</b>: A highly systemic herbicide against weeds on various crops.<br><b>Ignite 15 SL</b>: Non-selective herbicide with Glufosinate Ammonium that targets weeds<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>',
                        '3': 'Fungicides 🍄<br><br><b>STK Regev</b>: The first hybrid fungicide in the country: it has the joint efficacy of systemic fungicide and tea tree oil that controls diseases on crops.<br><b>Timorex Gold</b>: With its tea tree oil ingredient, Timorex Gold has the power to defend and heal planted vegetable crops against black sigatoka and other diseases<br><b>Domark Pro</b>: A systemic fungicide that targets anthracnose and stem-end rot in mango trees.<br><b>Manager 80 WP</b>: Its active ingredient, Mancozeb, helps in giving crops a long-lasting resistance against fungus. It also has zinc and manganese for added protection.<br><b>Armore 70 WP</b>: Being a systemic fungicide, Armor 70 WP seeps through the roots of the plant for longer effectivity.<br><b>Leadonil 500 SC</b>: A broad spectrum agricultural fungicide effective against a wide range of diseases in field, fruit and vegetable crops.<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>',
                        '4': 'Fertilizers 💧<br><br><b>iSmart Ceres</b>: A biostimulant that helps in the growth of crops, while also avoiding transplanting shock and abiotic stress due to extreme heat, flooding, and drought.<br><b>iSmart Boom Flower-n</b>: iSmart Boom Flower Improves flower initiation, improves fruit retention and assimilation, and increases fruit size, weight and quality.<br><b>iSmart Nano Urea</b>: This fertilizer helps bring Nitrogen to the plant on a nano sized level that allows for better absorption with reduced chances of wash off.<br><b>Kawa 422</b>: Kawa 422 is an organic fertilizer that\'s a good alternative to chicken manure as it\'s more cost-effective to use, and more eco-friendly.<br><b>MegaBooster</b>: MegaBooster is a water soluble foliar fertilizer that meets the high nutrient requirements of your crops during fruit development and ripening.<br><b>Tecamin Max</b>: A foliar biostimulant with amino acids that enhances qualities of vegetables by fighting abiotic stress<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>',
                        '5': 'Molluscicides 🐌<br><br><b>Niclos M Plus</b>: As a molluscicide, Niclos M Plus contains Niclosamide in wettable power formulation.<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>'
                    };
                    // Try to match product name (case-insensitive, partial match)
                    const userMsgLower = userMsg.toLowerCase();
                    const foundProduct = productInfoMap.find(p => userMsgLower.includes(p.name.toLowerCase()));
                    if (foundProduct) {
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage(foundProduct.info, true);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }
                    // If not a product name, check for category number
                    if (productCategoryResponses[userMsg]) {
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage(productCategoryResponses[userMsg], true);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }
                    // If not a product name or valid category number, show error and block fetch
                    if (
                        !productCategoryResponses[userMsg] &&
                        !productInfoMap.some(p => userMsg.toLowerCase().includes(p.name.toLowerCase()))
                    ) {
                        showTypingIndicator();
                        setTimeout(() => {
                            hideTypingIndicator();
                            addMessage('🤔 Uy, hindi ko masyadong na-gets ‘yan, Ka-Leads.<br><br>Type “MENU” o pindutin ang MAIN MENU button para bumalik sa main options.<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>', true);
                            chatInput.disabled = false;
                            sendBtn.disabled = false;
                            chatInput.focus();
                        }, 400);
                        return;
                    }

                    // If not found, you can show a fallback or send to AI
                    // For now, send to AI as usual
                }

                // Farming Tips removed

                // Only allow Mistral AI for technical support
                if (currentMenu !== 'technical-support') {
                    return;
                }

                // Show 3-dot typing indicator for technical support (Mistral AI answering)
                showTypingIndicator();

                let context = '';
                if (currentMenu === 'technical-support') {
                    context = `HERBICIDE\n🌿 Weeds/Damo? Subukan ang *Frontier 200 OD!* — post-emergent at nanunuot sa halaman.\n\n✅ Rescue application = best protection\n💧 Gamitin sa unang aplikasyon at bilang rescue application\n🥶 Malamig ang pormulasyon sa palay – hindi nasusunog ang halaman\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Frontier MAX!* — post-emergent herbicide na may halong Leads Exit.\n\n✅ Rescue application = best protection\n💧 Gamitin sa unang aplikasyon at bilang rescue application\n🥶 Malamig ang pormulasyon sa palay – hindi nasusunog ang halaman\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Mower 48 SL!* — foliar herbicide na nanunuot sa buong halaman at sa ugat nito para sa pag-kontrol ng damo.\n\n✅ Foliar = puwedeng i-apply sa dahon ng damo\n💧 Gamitin sa unang aplikasyon at bilang rescue application\n🥬 Pwedeng gamitin sa iba't-ibang tanim na gulay\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Mower Ultra 514 SL!* — post-emergent general weed killer na kumokontrol sa paglago at pagdami ng iba't-ibang damo sa taniman, lalo na sa maisan.\n\n✅ Systemic action = mabilis manuot sa damo\n💧 May kombinasyon ng mga kemikal na pumipigil sa shoot and root elongation o paglago ng damo\n❌ Walang latak sa taniman\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Agil 100 EC!* — post-emergent herbicide na pumupuksa sa damo sa tanim na sibuyas.\n\n☔ May rainfast formula = hindi basta nawawala kahit umuulan\n🧅 Mabisa sa tanim na sibuyas\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Top Ace 80 SC!* — post-emergent general weed killer na kumokontrol sa paglago at pagdami ng iba't-ibang damo sa taniman, lalo na sa maisan.\n\n✅ Systemic action = mabilis kumalat paloob sa mga ugat ng damo\n⏳ May long residual action kaya nananatili ang bisa\n👍 Puwede bilang pre-emergent, early post-emergent at late post-emergent\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Top Ace MAX!* — may pinagsamang pwersa ng Top Ace at Leads Exit\n\n✅ Mayroon tong Diuron = sangkap na nanunuot sa damo\n⏳ Malawak ang timing ng aplikasyon\n👍 Puwede bilang early hanggang post-emergent: pumupuksa sa damo sa iba't-ibang yugto ng paglaki nito\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!\n🌿 Weeds/Damo? Subukan ang *Ignite 15 SL!* — non-selective herbicide laban sa mga damong mahirap puksain at umaagaw sa nutrisyon ng mga tanim.\n\n✅ Maaaring gamitin bilang pamatay-damo sa cavendish bananas, rubber, oil palm, at bilang industrial weed control\n🏜️ Pwede sa sloping areas para maiwasan ang soil erosion\n\n📘 Need a full guide? Pwede ko i-PM sa'yo!`;
                }
                // Send to backend
                fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: userMsg, context: context })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    hideTypingIndicator();
                    chatInput.disabled = false;
                    sendBtn.disabled = false;
                    chatInput.focus();
                    if (data.response) {
                        addMessage(data.response, true);
                    } else if (data.error) {
                        addMessage('Error: ' + data.error, true);
                    } else {
                        addMessage('Sorry, there was an error. Please try again later.', true);
                    }
                })
                .catch((error) => {
                    console.error('Chat error:', error);
                    hideTypingIndicator();
                    chatInput.disabled = false;
                    sendBtn.disabled = false;
                    chatInput.focus();
                    addMessage('🤔 Uy, hindi ko masyadong na-gets \'yan, Ka-Leads.', true);
                });
            });

            // Capitalize only the first letter of the input automatically
            chatInput.addEventListener('input', function(e) {
                if (chatInput.value.length === 1) {
                    chatInput.value = chatInput.value.charAt(0).toUpperCase();
                } else if (chatInput.value.length > 1 && chatInput.value.charAt(0) !== chatInput.value.charAt(0).toUpperCase()) {
                    chatInput.value = chatInput.value.charAt(0).toUpperCase() + chatInput.value.slice(1);
                }
            });

            chatbotButton.onclick = function() {
                chatModal.classList.toggle('active');
                chatbotButton.classList.toggle('active');
                if (chatModal.classList.contains('active')) {
                    showAIChat();
                    if (!chatGreeted) {
                        chatGreeted = true;
                        addMessage("👋 Hello Ka-Leads! Ako si PandoyBot, ang digital farm buddy mo mula sa Leads Agri! May katanungan ka ba? Message ka lang!🌾", true);
                        setTimeout(() => {
                            showTypingIndicator();
                            setTimeout(() => {
                                hideTypingIndicator();
                                addMessage("Magandang araw, Ka-LEADS! Paano kita matutulungan ngayon? Pili ka lang sa sumusunod: <br><br>1️⃣ Product Info 📦<br>2️⃣ Technical Support 👨‍🌾<br>3️⃣ Talk to a Ka-Leads Expert ☎️<br><br>👉 I-type mo lang ang number o i-message kami para matulungan ka!", true);
                            }, 1000);
                        }, 500);
                    }
                }
            };
            closeModalButton.onclick = function() {
                chatModal.classList.remove('active');
                chatbotButton.classList.remove('active');

                // Reset conversation state
                conversationEnded = false;
                currentMenu = 'main';
                chatGreeted = false;

                // Clear chat messages
                chatBody.innerHTML = '';

                // Re-add FAQ section
                const newFaqSection = document.createElement('div');
                newFaqSection.className = 'faq-section';
                newFaqSection.id = 'faq-section';
                newFaqSection.innerHTML = '<div class="faq-buttons" id="faq-buttons"></div>';
                chatBody.appendChild(newFaqSection);

                // Reset FAQ section reference
                faqSection = newFaqSection;
            };
        });
    </script>
</body>

</html>
