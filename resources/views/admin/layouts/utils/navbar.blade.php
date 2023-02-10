<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('get.admin-demands') }}">Yardım Yeri</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('admin/demands*')) ? 'active' : '' }}" aria-current="page" href="{{ route('get.admin-demands') }}">Tüm Talapler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}" href="{{ route('get.admin-users') }}">Kullanıcılar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('admin/useful-links*')) ? 'active' : '' }}" href="{{ route('get.useful-links') }}">Faydalı Linkler</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="{{ route('logout') }}" class="btn btn-danger" type="submit">Çıkış Yap</a>
        </div>
      </div>
    </div>
  </nav>