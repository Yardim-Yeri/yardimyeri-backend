<!DOCTYPE html>
<html lang="te">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yardım Yeri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/sass/app.scss'])
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
            <div class="container">
                <a class="navbar-brand w-100 text-center m-0" href="/">YARDIMYERİ.COM</a>
            </div>
        </nav>
    </header>

    <main class="py-5">
        @yield('content')
    </main>

    <footer>
        <div class="copyright text-center border-top mt-5 py-4">
            © 2023 YARDIMYERİ.COM
        </div>
    </footer>

    @vite(['resources/js/app.js'])

    @yield('script')

</body>

</html>
