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
      
      @include('_partials.header')

      @include('_partials.navbar')

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
            <div class="row gx-md-4">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-vertical mx-0 -mx-sm-1">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link {{ active('profile') }}">Edit Profil</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
          </div>
        </div>
        
        @include('_partials.footer')

      </div>
    </div>
    
    @include('_partials.logout')

    @include('_includes.foot')

  </body>
</html>