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
        @yield('content')
        
        @include('_partials.footer')

      </div>
    </div>
    
    @include('_partials.logout')

    @include('_includes.foot')

  </body>
</html>