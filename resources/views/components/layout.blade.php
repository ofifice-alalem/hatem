<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'نظام الإدارة' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1218d9',
                        'dark-blue': {
                            '50': '#eaf2ff',
                            '100': '#d9e7ff',
                            '200': '#bad1ff',
                            '300': '#91b3ff',
                            '400': '#6686ff',
                            '500': '#425bff',
                            '600': '#212bff',
                            '700': '#1218d9',
                            '800': '#151cbe',
                            '900': '#1b2494',
                            '950': '#101356'
                        },
                        secondary: '#f3f4f6'
                    },
                    fontFamily: {
                        'sans': ['Tajawal', 'ui-sans-serif', 'system-ui']
                    },
                    boxShadow: {
                        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                        'card': '0 4px 12px rgba(18, 24, 217, 0.08)'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/dark-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light-theme.css') }}">
    <style>
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
        body {
            background: #0f0f1e;
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .gradient-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #4c6ef5 100%);
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.5);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.7);
        }
        /* Light Mode */
        body.light-mode {
            background: #f3f4f6 !important;
        }
        body.light-mode .glass-effect {
            background: rgba(255, 255, 255, 0.9) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }
        body.light-mode .text-white { color: #111827 !important; }
        body.light-mode .text-gray-300 { color: #4b5563 !important; }
        body.light-mode .text-gray-400 { color: #6b7280 !important; }
        body.light-mode .bg-white\/5 { background: rgba(0, 0, 0, 0.05) !important; }
        body.light-mode .bg-white\/10 { background: rgba(0, 0, 0, 0.1) !important; }
        body.light-mode .border-white\/10 { border-color: rgba(0, 0, 0, 0.1) !important; }
        body.light-mode .divide-white\/10 > * { border-color: rgba(0, 0, 0, 0.1) !important; }
        body.light-mode #themeBtn { background: rgba(0, 0, 0, 0.1) !important; color: #111827 !important; }
        body.light-mode #themeBtn:hover { background: rgba(0, 0, 0, 0.15) !important; }
        body.light-mode #addBtn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
        body.light-mode #deleteBtn { background: #dc2626 !important; }
        body.light-mode select option { background: white !important; color: #111827 !important; }
        body.light-mode .gradient-purple { color: white !important; }
        body.light-mode .gradient-purple * { color: white !important; }
        body.light-mode .hover\:bg-white\/10:hover { background: rgba(0, 0, 0, 0.05) !important; }
        body.light-mode .hover\:bg-white\/5:hover { background: rgba(0, 0, 0, 0.03) !important; }
        body.light-mode .text-dark-blue-600,
        body.light-mode .text-dark-blue-700,
        body.light-mode .text-dark-blue-800 { color: #667eea !important; }
        body.light-mode .text-purple-600,
        body.light-mode .text-purple-700,
        body.light-mode .text-purple-800 { color: #9333ea !important; }
        body.light-mode .text-yellow-600 { color: #ca8a04 !important; }
        body.light-mode .text-green-600 { color: #16a34a !important; }
        body.light-mode .text-blue-600 { color: #2563eb !important; }
        body.light-mode .text-red-600 { color: #dc2626 !important; }
        body.light-mode .text-orange-600 { color: #ea580c !important; }
        body.light-mode .text-indigo-600 { color: #4f46e5 !important; }
        body.light-mode .text-cyan-600 { color: #0891b2 !important; }
        body.light-mode .bg-dark-blue-100,
        body.light-mode .bg-dark-blue-200 { background: #e0e7ff !important; }
        body.light-mode .bg-purple-100 { background: #f3e8ff !important; }
        body.light-mode .bg-yellow-100 { background: #fef3c7 !important; }
        body.light-mode .bg-green-100 { background: #dcfce7 !important; }
        body.light-mode .bg-blue-100 { background: #dbeafe !important; }
        body.light-mode .bg-red-100 { background: #fee2e2 !important; }
        body.light-mode .bg-orange-100 { background: #ffedd5 !important; }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ $head ?? '' }}
</head>
<body class="font-sans">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="mr-72 p-8">
            {{ $slot }}
        </div>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
            const icon = document.getElementById('globalThemeIcon');
            const text = document.getElementById('themeText');
            if (document.body.classList.contains('light-mode')) {
                icon.innerHTML = '<path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>';
                if(text) text.textContent = 'الوضع الداكن';
            } else {
                icon.innerHTML = '<path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>';
                if(text) text.textContent = 'الوضع الفاتح';
            }
            localStorage.setItem('theme', document.body.classList.contains('light-mode') ? 'light' : 'dark');
        }
        
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light-mode');
            const icon = document.getElementById('globalThemeIcon');
            const text = document.getElementById('themeText');
            if(icon) icon.innerHTML = '<path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>';
            if(text) text.textContent = 'الوضع الداكن';
        }
    </script>

    {{ $scripts ?? '' }}
</body>
</html>