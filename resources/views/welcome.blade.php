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
        }

        @media (max-width: 768px) {
            .chatbot-button {
                width: 50px;
                height: 50px;
                font-size: 20px;
                bottom: 15px;
                right: 15px;
            }
        }

        .chatbot-button:hover {
            transform: scale(1.1);
            background-color: #388E3C;
        }

        .chatbot-button.active {
            transform: rotate(45deg);
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

            .chat-modal-footer .image-upload-button {
                padding: 8px 12px;
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
            /* margin-left: 10px; Removed, gap handles spacing */
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-modal-footer button:hover {
            background-color: #388E3C;
        }

        .chat-modal-footer .image-upload-button {
            background-color: #2E7D32;
            /* margin-left: 10px; Removed, gap handles spacing */
            padding: 10px 15px;
            border-radius: 20px;
        }

        .chat-modal-footer .image-upload-button:hover {
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
    </style>
    
    <!-- Main styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased">
    <div id="app"></div>

    <button id="chatbot-button" class="chatbot-button">
        <i class="fas fa-comment-dots"></i>
    </button>

    <div id="chat-modal" class="chat-modal">
        <div class="chat-modal-header">
            <h4>🌿 LeadsAgri Bot</h4>
            <button class="chat-modal-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="chat-modal-body">
            <!-- Chat messages will go here -->
            <p class="message received">Hello! How can I help you today?</p>
        </div>
        <div class="chat-modal-footer">
            <input type="text" placeholder="Type your message...">
            <input type="file" id="image-input" accept="image/*" style="display: none;">
            <button id="image-button" class="image-upload-button">
                <i class="fas fa-camera"></i>
            </button>
            <button id="send-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotButton = document.getElementById('chatbot-button');
            const chatModal = document.getElementById('chat-modal');
            const closeModalButton = document.querySelector('.chat-modal-close');
            const chatInput = chatModal.querySelector('input[type="text"]');
            const sendButton = document.getElementById('send-button');
            const chatBody = chatModal.querySelector('.chat-modal-body');
            const imageInput = document.getElementById('image-input');
            const imageButton = document.getElementById('image-button');

            // Add loading state
            function setLoading(isLoading) {
                sendButton.disabled = isLoading;
                chatInput.disabled = isLoading;
                imageButton.disabled = isLoading;
                if (isLoading) {
                    sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                } else {
                    sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
                }
            }

            // Function to add a message to the chat
            function addMessage(content, isReceived = false) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                if (isReceived) {
                    messageElement.classList.add('received');
                }
                messageElement.textContent = content;
                chatBody.appendChild(messageElement);
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            // Function to show typing indicator
            function showTypingIndicator() {
                let typing = document.getElementById('typing-indicator');
                if (!typing) {
                    typing = document.createElement('div');
                    typing.id = 'typing-indicator';
                    typing.className = 'message received typing-indicator';
                    typing.innerHTML = '<span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>';
                    chatBody.appendChild(typing);
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            }

            // Function to hide typing indicator
            function hideTypingIndicator() {
                const typing = document.getElementById('typing-indicator');
                if (typing) {
                    typing.remove();
                }
            }

            // Function to send a message
            async function sendMessage() {
                const messageText = chatInput.value.trim();
                if (messageText === '') return;

                // Add user message to chat
                addMessage(messageText);
                chatInput.value = '';

                // Show loading state and typing indicator
                setLoading(true);
                showTypingIndicator();

                try {
                    const response = await fetch('/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ message: messageText })
                    });

                    const data = await response.json();

                    // Hide typing indicator
                    hideTypingIndicator();

                    if (response.ok) {
                        // Add bot response to chat
                        addMessage(data.response, true);
                    } else {
                        // Handle error
                        addMessage('Sorry, I encountered an error. Please try again later.', true);
                        console.error('Chat error:', data.error);
                    }
                } catch (error) {
                    hideTypingIndicator();
                    console.error('Error:', error);
                    addMessage('Sorry, I encountered an error. Please try again later.', true);
                } finally {
                    setLoading(false);
                }
            }

            // Event listeners
            chatbotButton.addEventListener('click', function() {
                chatModal.classList.toggle('active');
                chatbotButton.classList.toggle('active');
                if (chatModal.classList.contains('active')) {
                    chatInput.focus();
                }
            });

            closeModalButton.addEventListener('click', function() {
                chatModal.classList.remove('active');
                chatbotButton.classList.remove('active');
            });

            sendButton.addEventListener('click', sendMessage);

            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            imageButton.addEventListener('click', function() {
                imageInput.click();
            });

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const imageFile = this.files[0];
                    addMessage(`Image selected: ${imageFile.name}`);
                    // Note: Image upload functionality can be added later if needed
                }
            });
        });
    </script>
</body>

</html>
