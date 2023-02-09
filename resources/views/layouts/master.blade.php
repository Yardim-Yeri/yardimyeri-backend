<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yardım Yeri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/sass/app.scss'])
    @yield('styles')

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

    <header>
        <nav class="navbar navbar-light bg-light p-2">
            <a class="navbar-brand" href="/">YARDIMYERİ.COM</a>


            <div class=" ">
                <a class="navbar-brand" href="/yararli-linkler">Yararlı Linkler</a>
            </div>
          </nav>
        </nav>
    </header>

    <div class="alert alert-warning text-center">
        Bu bir sosyal sorumluluk projesidir. Bilgileriniz KVKK güvencesiyle saklanmaktadır.
    </div>

    <main class="py-5">
        @yield('content')
    </main>

    <footer>
        <div class="copyright text-center border-top mt-5 py-4">
            <span class="d-inline-block">Geri Bildirim: </span><a href="mailto:yardimyeri.info@gmail.com" target="_blank" class="d-inline-block">Mail Gönder</a>
            <span class="ms-4">© 2023 YARDIMYERİ.COM</span>
        </div>
    </footer>

    @vite(['resources/js/app.js'])

    @yield('script')

</body>

</html>
