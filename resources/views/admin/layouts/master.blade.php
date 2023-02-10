<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yardım Yeri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/sass/app.scss'])

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4W6EXM5HMX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4W6EXM5HMX');
    </script>
</head>

<body>

    @include('admin.layouts.utils.navbar')

    <div class="container-fluid py-5">
        <div class="m-5">
            @yield('admin-content')
        </div>
            
        
    </div>
    
    @vite(['resources/js/admin.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @yield('script')
    @stack('sc')


</body>

</html>
