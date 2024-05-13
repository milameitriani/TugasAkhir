<div class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item {{ active('admin') }}">
            <a class="nav-link" href="{{ route('admin.home') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
              </span>
              <span class="nav-link-title">
                Beranda
              </span>
            </a>
          </li>
          @canany(['admin'])
          <li class="nav-item {{ active('admin/categories') }} {{ active('admin/menus', 'active', true) }} {{ active('admin/tables') }} {{ active('admin/users') }} {{ active('admin/admins') }} dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
              </span>
              <span class="nav-link-title">
                Master
              </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  @canany(['admin'])
                  <a class="dropdown-item {{ active('admin/categories') }}" href="{{ route('admin.categories') }}" >
                    Kategori Menu
                  </a>
                  @endcan
                  <a class="dropdown-item {{ active('admin/menus', 'active', true) }}" href="{{ route('admin.menus.index') }}" >
                    Menu
                  </a>
                  @canany(['admin'])
                  <a class="dropdown-item {{ active('admin/tables') }}" href="{{ route('admin.tables') }}" >
                    Meja
                  </a>
                  <a class="dropdown-item {{ active('admin/users') }}" href="{{ route('admin.users') }}" >
                    Pelanggan / Pengguna
                  </a>
                  <a class="dropdown-item {{ active('admin/admins') }}" href="{{ route('admin.admins') }}" >
                    Petugas
                  </a>
                  @endcan
                </div>
              </div>
            </div>
          </li>
          @endcan
          <li class="nav-item {{ active('admin/orders', 'active', true) }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="3" width="16" height="18" rx="2" /><rect x="8" y="7" width="8" height="3" rx="1" /><line x1="8" y1="14" x2="8" y2="14.01" /><line x1="12" y1="14" x2="12" y2="14.01" /><line x1="16" y1="14" x2="16" y2="14.01" /><line x1="8" y1="17" x2="8" y2="17.01" /><line x1="12" y1="17" x2="12" y2="17.01" /><line x1="16" y1="17" x2="16" y2="17.01" /></svg> 
              </span>
              <span class="nav-link-title">
                Order
              </span>
            </a>
          </li>
          @canany(['admin', 'kasir'])
          <li class="nav-item dropdown {{ active('admin/reports', 'active', true) }}">
            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 14v4h4" /><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" /><rect x="8" y="3" width="6" height="4" rx="2" /><circle cx="18" cy="18" r="4" /><path d="M8 11h4" /><path d="M8 15h3" /></svg>
              </span>
              <span class="nav-link-title">
                Laporan
              </span>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item {{ active('admin/reports/date') }}" href="{{ route('admin.reports.date') }}">
                Per Hari
              </a>
              <a class="dropdown-item {{ active('admin/reports/month') }}" href="{{ route('admin.reports.month') }}">
                Per Bulan
              </a>
              <a class="dropdown-item {{ active('admin/reports/period') }}" href="{{ route('admin.reports.period') }}">
                Per Periode
              </a>
              <a class="dropdown-item" target="_blank" href="{{ route('admin.reports.print.all') }}">
                Semua
              </a>
            </div>
          </li>
          @endcan
        </ul>
        <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
          <form action="{{ route('admin.orders.create') }}" method="get">
            <div class="input-icon">
              <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
              </span>
              <input type="search" class="form-control" placeholder="Cari" name="search">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>