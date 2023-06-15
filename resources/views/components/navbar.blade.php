<nav class="navbar navbar-expand-lg bg-dark border-bottom border-1" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">The Aulab Post</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('article.index')}}">Leggi gli Articoli</a>
        </li>
        @guest
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ospite
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
            <li><a class="dropdown-item" href="{{route('register')}}">Registrati</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{route('myProfile')}}" class="dropdown-item list-cst">Il mio profilo</a>
            </li>
            @if (Auth::user()->is_admin)
            <li>
              <a href="{{route('admin.dashboard')}}" class="dropdown-item list-cst">Dashboard Admin</a>
            </li>           
            @endif
            @if (Auth::user()->is_revisor)
            <li>
              <a href="{{route('revisor.dashboard')}}" class="dropdown-item list-cst">Dashboard Revisor</a>
            </li>           
            @endif
            @if (Auth::user()->is_writer)
            <li>
              <a href="{{route('article.create')}}" class="dropdown-item list-cst">Inserisci Articolo</a>
            </li>         
            @endif
            <li>
              <a href="{{route('careers')}}" class="dropdown-item list-cst">Lavora con noi</a>
            </li>
            <li><a class="dropdown-item list-cst" href="{{route('logout')}}" onclick="event.preventDefault(); getElementById('form-logout').submit();">Logout</a>
              <form id="form-logout" action="{{route('logout')}}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @endguest
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>