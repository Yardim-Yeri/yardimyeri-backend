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

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Sign out</a>
          </div>
        </div>
      </header>

    <div class="container-fluid">
        <div class="row">
            @include('admin.layouts.utils.navbar')
        </div>
        <div class="m-5">
            @yield('admin-content')
        </div>
            
        
    </div>
    
    
    
       
  
    <footer class="fixed-bottom">
        <div class="copyright text-center border-top mt-5 py-4">
            <span class="d-inline-block">Geri Bildirim: </span><a href="mailto:yardimyeri.info@gmail.com" target="_blank" class="d-inline-block">Mail Gönder</a>
            <span class="ms-4">© 2023 YARDIMYERİ.COM</span>
        </div>
    </footer>

    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @yield('script')
    @stack('sc')

</body>

</html>
