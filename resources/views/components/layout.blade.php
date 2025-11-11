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