<header id="header">
  <a class="logo" href="/">Student Attendance System</a>
  <nav>
    <a href="#menu">Menu</a>
  </nav>
  </header>
  
  <nav id="menu">
  <ul class="links">
    <li><a href="{{route(auth()->user()->role.'.main', session('id'))}}">Home</a></li>
    {{-- <li>{{auth()->user()->role}}</li> --}}
    <li><a href="{{route('logout')}}">Log Out</a></li>
  </ul>
</nav>