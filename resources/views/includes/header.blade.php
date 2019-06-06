<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href='{{route("home_path")}}'>Portal pracy</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href='{{url("/praca")}}'>Praca</a>
      </li>
      @if(!Auth::user())
      <li class="nav-item">
          <a class="nav-link" href='{{route("login")}}'>Zaloguj się</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href='{{route("register")}}'>Załóż konto</a>
      </li>
      @endif
      @auth
      @if(Auth::user()->roles()->first()->name=='admin')
      <li class="nav-item">
        <a class="nav-link" href='{{url("/admin")}}'>Admin</a>
      </li>
      @endif
      <li class="nav-item">
          <a class="nav-link" href='{{route("account_path")}}'>Konto</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href='{{route("logout")}}'>Wyloguj się</a>
      </li>      
      @endauth
      
    </ul>
  </div>
</nav>