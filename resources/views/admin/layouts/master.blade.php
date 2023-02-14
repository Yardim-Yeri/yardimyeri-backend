<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yardım Yeri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="15">

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<body>

    @include('admin.layouts.utils.navbar')

    <div class="container-fluid">
        <div class="m-5 pt-5 pb-5">
            @yield('admin-content')
        </div>
    </div>

    <footer class="fixed-bottom">
        <div class="copyright text-center border-top mt-5 py-4">
            <span class="d-inline-block">Geri Bildirim: </span><a href="mailto:yardimyeri.info@gmail.com"
                target="_blank" class="d-inline-block">Mail Gönder</a>
            <span class="ms-4">© 2023 YARDIMYERİ.COM</span>
        </div>
    </footer>

    @vite(['resources/js/admin.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @yield('script')

    @stack('sc')
</body>

</html>
