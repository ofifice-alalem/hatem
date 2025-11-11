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

    {{ $scripts ?? '' }}
</body>
</html>