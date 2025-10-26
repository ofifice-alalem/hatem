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
                    }
                }
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ $head ?? '' }}
</head>
<body class="bg-gray-50 font-sans">
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