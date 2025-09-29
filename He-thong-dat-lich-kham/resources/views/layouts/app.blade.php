<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>MediBook</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Dropdown ẩn mặc định */
        .nav-item .dropdown {
            display: none;
            position: absolute;
            top: 65%;
            left: 100;
            background: white;
            width: 220px;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            z-index: 999;
        }

        /* Khi hover vào li.nav-item thì hiện dropdown */
        .nav-item:hover .dropdown {
            display: block;
        }

        .dropdown a {
            display: block;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
        }

        .dropdown a:hover {
            background: #f0fdfa;
            color: #0d9488;
        }
    </style>
</head>

<body class="font-sans antialiased">

    @include('layouts.header')

    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    @include('layouts.footer')

</body>

</html>