<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta3
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    
    @include('_includes.head')

  </head>
  <body class="antialiased">
    <div class="wrapper">
      
      @include('_partials.admin.header')

      @include('_partials.admin.navbar')

      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-pretitle">
                  @yield('pretitle')
                </div>
                <h2 class="page-title">
                  @yield('title')
                </h2>
              </div>
              <div class="col-auto ms-auto">
                <div class="btn-list">
                  @yield('button')
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>
        
        @include('_partials.footer')

      </div>
    </div>
    
    @include('_partials.admin.logout')

    @include('_includes.foot')

    <script>
      const getNotificationsUrl = '{{ route('ajax.admin.notifications') }}'
      const ordersUrl = '{{ route('admin.orders.index') }}'
      const usersUrl = '{{ route('admin.users') }}'
    </script>

    @canany(['admin', 'bar', 'koki', 'pelayanan'])
    <script src="{{ asset('js/admin/notification.js') }}"></script>
    @endcan

  </body>
</html>