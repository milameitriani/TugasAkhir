<header class="navbar navbar-expand-md navbar-light d-print-none">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <img src="{{ asset('logo.png') }}" width="70" height="50" class="me-3" />
      <a href="{{ route('home') }}">
        {{ config('setting.name') }}
      </a>
    </h1>
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item dropdown">
        @auth
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <div class="d-block d-md-none">
              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
            </div>
            <div class="d-none d-md-block ps-0">
              <div>{{ user('name') }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ route('profile') }}" class="dropdown-item">Profil Saya</a>
            <div class="dropdown-divider"></div>
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">Keluar</button>
          </div>
        @endauth
      </div>
      @guest
        <div class="nav-item">
          <a href="{{ route('login') }}" class="nav-link w-auto">Masuk</a>
        </div>
      @endguest
    </div>
  </div>
</header>