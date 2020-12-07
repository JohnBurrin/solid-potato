{{-- This is a copy of the orginal backpack plain template --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">
<head>
    @include(backpack_view('inc.head'))
</head>
<body class="{{ config('backpack.base.body_class') }}">

  @yield('header')

  <div class="container">
  @yield('content')
  </div>

  <footer class="app-footer sticky-footer">
    @include('backpack::inc.footer')
  </footer>

  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @yield('after_scripts')
  @stack('after_scripts')

</body>
</html>
