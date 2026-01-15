<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ChatPGE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif !important;
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        
        {{-- Sidebar / Info Panel --}}
        <div class="hidden lg:flex lg:w-2/5 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 p-12 flex-col justify-center items-center relative overflow-hidden">
            
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-md">
                <div class="mb-8">
                    <div class="bg-white rounded-xl p-4 inline-block shadow-lg">
                        <img src="{{ asset('/images/LOGO-PGE.png') }}" class="h-10" alt="PGE Logo" />
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold text-white mb-4">
                    Selamat Datang di<br/>ChatPGE 👋
                </h1>
                
                <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                    Asisten virtual cerdas untuk membantu Anda menemukan informasi dokumen, panduan sistem, dan layanan PT Pertamina Geothermal Energy.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3 bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">Pencarian Dokumen</h3>
                            <p class="text-sm text-blue-100">Temukan dokumen dengan cepat dan mudah</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">Panduan Sistem</h3>
                            <p class="text-sm text-blue-100">Dapatkan bantuan penggunaan sistem</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">Respon Cepat 24/7</h3>
                            <p class="text-sm text-blue-100">Siap membantu kapan saja Anda butuhkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chat Panel --}}
        <div class="flex-1 flex flex-col bg-gradient-to-b from-blue-500 to-blue-600">
            
            {{-- Header with Blue Gradient --}}
            <div class="bg-transparent px-6 py-6">
                <div class="flex items-center justify-between mb-3">
                    <a href="/" class="text-white hover:text-blue-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <button id="clearChat" class="text-white hover:text-blue-100 transition" title="Clear Chat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg p-2">
                            <img src="{{ asset('/images/LOGO-PGE.png') }}" class="w-full h-full object-contain" alt="PGE Logo" />
                        </div>
                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-400 border-2 border-blue-600 rounded-full"></span>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-xl">ChatPGE</h2>
                        <p class="text-sm text-white font-medium">Online</p>
                    </div>
                </div>
            </div>

            {{-- Messages Area --}}
            <div id="chatMessages" class="flex-1 overflow-y-auto px-4 py-6 bg-gray-50 rounded-t-3xl">
                <div class="max-w-3xl mx-auto space-y-4">
                    
                    {{-- Welcome Message --}}
                    <div class="flex justify-start message-animation">
                        <div class="flex items-end space-x-2 max-w-[75%]">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-md p-1 border border-gray-200">
                                    <img src="{{ asset('/images/LOGO-PGE.png') }}" class="w-full h-full object-contain" alt="PGE" />
                                </div>
                            </div>
                            <div>
                                <div class="bg-white rounded-2xl rounded-bl-sm px-4 py-3 shadow-sm">
                                    <p class="text-gray-800 text-sm font-medium">Halo! 👋 Saya ChatPGE. Bagaimana saya bisa membantu Anda hari ini?</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Questions --}}
                    <div class="flex justify-start">
                        <div class="max-w-[75%] ml-10">
                            <p class="text-xs text-gray-600 mb-2 font-medium">Pertanyaan yang sering diajukan:</p>
                            <div class="space-y-2">
                                <button class="quick-question w-full text-left px-4 py-3 bg-white hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded-xl text-sm text-gray-700 hover:text-blue-700 transition-all shadow-sm">
                                    📄 Bagaimana cara mencari dokumen?
                                </button>
                                <button class="quick-question w-full text-left px-4 py-3 bg-white hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded-xl text-sm text-gray-700 hover:text-blue-700 transition-all shadow-sm">
                                    ℹ️ Apa itu PGE Repository?
                                </button>
                                <button class="quick-question w-full text-left px-4 py-3 bg-white hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded-xl text-sm text-gray-700 hover:text-blue-700 transition-all shadow-sm">
                                    📞 Bagaimana cara menghubungi support?
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Input Area --}}
            <div class="bg-white px-4 py-4 border-t border-gray-200">
                <div class="max-w-3xl mx-auto">
                    <form id="chatForm" class="flex items-center space-x-3">
                        @csrf
                        <div class="flex-1 relative">
                            <textarea 
                                id="messageInput" 
                                rows="1"
                                placeholder="Ketik pesan Anda..." 
                                class="w-full px-4 py-3 pr-12 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none placeholder-gray-500"
                                style="max-height: 120px; color: #000000; font-weight: 500;"
                            ></textarea>
                        </div>
                        <button 
                            type="submit" 
                            id="sendButton"
                            class="flex-shrink-0 bg-blue-600 text-white p-4 rounded-full hover:bg-blue-700 transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-animation {
            animation: slideUp 0.3s ease-out;
        }

        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: transparent;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        #messageInput {
            overflow-y: hidden;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');
            const chatMessages = document.getElementById('chatMessages');
            const quickQuestions = document.querySelectorAll('.quick-question');
            const clearChatBtn = document.getElementById('clearChat');

            // Auto-resize textarea
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            // Handle Enter key
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.dispatchEvent(new Event('submit'));
                }
            });

            // Clear chat
            clearChatBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus semua pesan?')) {
                    location.reload();
                }
            });

            // Handle form submission
            chatForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const message = messageInput.value.trim();
                if (!message) return;

                // Hide quick questions
                const container = chatMessages.querySelector('.max-w-3xl');
                const quickQuestionsDiv = container.querySelector('.flex.justify-start:last-child');
                if (quickQuestionsDiv && quickQuestionsDiv.querySelector('.quick-question')) {
                    quickQuestionsDiv.style.display = 'none';
                }

                // Disable input
                messageInput.disabled = true;
                sendButton.disabled = true;

                // Add user message
                addMessage(message, 'user');
                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Show typing indicator
                const typingId = showTypingIndicator();

                try {
                    const response = await fetch('{{ route('chatbot.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ message: message })
                    });

                    const data = await response.json();
                    removeTypingIndicator(typingId);

                    if (data.success) {
                        addMessage(data.message, 'bot', data.intent);
                    } else {
                        addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
                    }
                } catch (error) {
                    removeTypingIndicator(typingId);
                    addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
                    console.error('Error:', error);
                }

                messageInput.disabled = false;
                sendButton.disabled = false;
                messageInput.focus();
            });

            // Handle quick questions
            quickQuestions.forEach(button => {
                button.addEventListener('click', function() {
                    const text = this.textContent.trim();
                    const cleanText = text.replace(/[\u{1F300}-\u{1F9FF}]/gu, '').trim();
                    messageInput.value = cleanText;
                    chatForm.dispatchEvent(new Event('submit'));
                });
            });

            // Add message
            function addMessage(text, sender, intent = null) {
                const container = chatMessages.querySelector('.max-w-3xl');
                const messageDiv = document.createElement('div');
                messageDiv.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'} message-animation`;

                if (sender === 'user') {
                    messageDiv.innerHTML = `
                        <div class="flex items-end space-x-2 max-w-[75%] flex-row-reverse space-x-reverse">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="bg-blue-600 rounded-2xl rounded-br-sm px-4 py-3 shadow-md">
                                    <p class="text-white text-sm whitespace-pre-wrap font-medium">${escapeHtml(text)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="flex items-end space-x-2 max-w-[75%]">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-md p-1 border border-gray-200">
                                    <img src="{{ asset('/images/LOGO-PGE.png') }}" class="w-full h-full object-contain" alt="PGE" />
                                </div>
                            </div>
                            <div>
                                <div class="bg-white rounded-2xl rounded-bl-sm px-4 py-3 shadow-sm">
                                    <p class="text-gray-800 text-sm whitespace-pre-wrap font-medium">${escapeHtml(text)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                }

                container.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Show typing indicator
            function showTypingIndicator() {
                const container = chatMessages.querySelector('.max-w-3xl');
                const typingDiv = document.createElement('div');
                typingDiv.className = 'flex justify-start typing-indicator';
                typingDiv.id = 'typing-' + Date.now();
                
                typingDiv.innerHTML = `
                    <div class="flex items-end space-x-2 max-w-[75%]">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-md p-1 border border-gray-200">
                                <img src="{{ asset('/images/LOGO-PGE.png') }}" class="w-full h-full object-contain" alt="PGE" />
                            </div>
                        </div>
                        <div>
                            <div class="bg-white rounded-2xl rounded-bl-sm px-4 py-3 shadow-sm">
                                <div class="flex space-x-1.5">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(typingDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                return typingDiv.id;
            }

            function removeTypingIndicator(id) {
                const typingDiv = document.getElementById(id);
                if (typingDiv) typingDiv.remove();
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
        });
    </script>

</body>
</html>
