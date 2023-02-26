<!doctype html>
<html lang="en">
  <head>
   @include('student.layouts.inc.header')
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  @include('student.layouts.inc.topNav')
</nav>

@yield('content')

<footer class="bg-dark text-white p-4">
@include('student.layouts.inc.footer')
</footer>
    
@include('student.layouts.inc.script')

@yield('script')
    
  </body>
</html>