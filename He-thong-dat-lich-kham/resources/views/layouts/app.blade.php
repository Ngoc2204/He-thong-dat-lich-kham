<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>MediBook</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="font-sans antialiased">

    @include('layouts.header')

    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    @include('layouts.footer')

</body>
</html>
