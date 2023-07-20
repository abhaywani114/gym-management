<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Gym Management')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
      <header>
        @include('components.navbar')
        @include('components.sidebar')
      </header>
        @yield('content')
        @include('components.footer')
        <script src="{{asset('/js/jquery-3.6.1.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
        <script>
          $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('@csrf').val(),
            }
          });

        </script>
        @yield('js')
    </body>
</html>
