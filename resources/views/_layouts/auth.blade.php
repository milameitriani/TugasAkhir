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
    
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="{{ route('home') }}"><h1>{{ config('setting.name') }}</h1></a>
        </div>

        @yield('content')
      </div>
    </div>

    @include('_includes.foot', ['some' => 'data'])

  </body>
</html>