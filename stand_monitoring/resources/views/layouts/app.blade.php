<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <!-- bootstrap -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <!-- <script src="/docs/5.3/assets/js/color-modes.js"></script> -->
    <title>@yield('title', 'Account')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <!-- <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->
    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    
    <style>
      /* rect {
        fill: #0a1e32;  
          rgb(85, 89, 92), 
          #212529 - natives gray color; 
          bs-border-color: #495057,
          bs-border-color-translucent: rgba(255, 255, 255, 0.15) - border;
      } */

    .hidden {
      opacity: 0;
      transition: all 1s ease-in-out;
    }

    .alert-icon {
      fill: white;
    }

    .rotate-rectangle-around-icon {
      transform: rotate(45);
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #252527;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .form-search {
      margin-top: 7rem;
      margin-bottom: 2rem;
      width: 1300px;
    }

    .btn-primary {
      --bs-btn-color: #fff;
      --bs-btn-bg: #212529;
      --bs-btn-border-color: #495057;
      --bs-btn-hover-color: #fff;
      --bs-btn-hover-bg: #495057;
      --bs-btn-hover-border-color: #495057;
      --bs-btn-focus-shadow-rgb: 49,132,253;
      --bs-btn-active-color: #fff;
      --bs-btn-active-bg: #212529;
      --bs-btn-active-border-color: #495057;
      --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      --bs-btn-disabled-color: #fff;
      --bs-btn-disabled-bg: #212529;
      --bs-btn-disabled-border-color: #495057;
    }

    .pagination {
      --bs-pagination-padding-x: 0.75rem;
      --bs-pagination-padding-y: 0.375rem;
      --bs-pagination-font-size: 1rem;
      --bs-pagination-color: rgb(0, 0, 0);
      --bs-pagination-bg: var(--bs-body-bg);
      --bs-pagination-border-width: var(--bs-border-width);
      --bs-pagination-border-color: var(--bs-border-color);
      --bs-pagination-border-radius: var(--bs-border-radius);
      --bs-pagination-hover-color: #212529;
      --bs-pagination-hover-bg: var(--bs-tertiary-bg);
      --bs-pagination-hover-border-color: var(--bs-border-color);
      --bs-pagination-focus-color: #212529;
      --bs-pagination-focus-bg: var(--bs-secondary-bg);
      --bs-pagination-focus-box-shadow: #212529;
      --bs-pagination-active-color: #fff;
      --bs-pagination-active-bg: #212529;
      --bs-pagination-active-border-color: #212529;
      --bs-pagination-disabled-color: var(--bs-secondary-color);
      --bs-pagination-disabled-bg: var(--bs-secondary-bg);
      --bs-pagination-disabled-border-color: var(--bs-border-color);
      display: flex;
      padding-left: 0;
      list-style: none;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }
  </style>
</head>
<body>
    
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>
    <div id="app">
    <header data-bs-theme="dark">
        <div class="collapse text-bg-dark" id="navbarHeader">
            <div class="container">
            <div class="row">
                <div class="col-sm-2 col-md-7 py-4">
                <h4>Информация о пользователе</h4>
                @auth
                <p class="text-body-secondary">
                    Пользователь <strong>{{ Auth::user()->name }}</strong>, авторизирован как <b>{{ Auth::user()->Role }}</b>
                </p> <br>
                <p class="text-body-secondary">
                    Права, доступные действия пользователя:
                    @role('admin')
                    <ul class="navbar-nav me-auto">
                      <a class="nav-link" href="{{route('monitoring.create')}}">Добавить метку</a>
                    </ul>
                    <ul class="navbar-nav me-auto">
                      Изменить метку
                    </ul> 
                    <ul class="navbar-nav me-auto">
                      Удалить метку
                    </ul> 
                    <ul class="navbar-nav me-auto">
                      Восстановить метку
                    </ul> 
                    <ul class="navbar-nav me-auto">
                      Просмотр удалённых меток
                    </ul> 
                    @endrole
                    @role('operator')
                    <ul class="navbar-nav me-auto">
                      Просмотр меток
                    </ul> 
                    @endrole
                    <ul class="navbar-nav me-auto">
                      Более подробная информация о возможностях и правах написана в личном кабинете пользователя.
                    </ul> 
                </p>
                @endauth
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                <h4>Учётная запись</h4>
                <ul class="list-unstyled">
                @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Авторизоваться</a>
                    </li>
                    @endif
                @else
                <ul class="navbar-nav me-auto">
                    <a id="navbarDropdown" class="nav-link" href="/home" role="button">
                    <strong>{{ Auth::user()->name }}</strong>
                    </a>
                </ul>

                <ul class="navbar-nav me-auto">          
                    <a class="nav-link" href="{{ route('monitoring.index') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Выйти из учётной записи
                    </a>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                    @endguest
                </ul>
                </div>
            </div>
            </div>
        </div>

        @php 
          $route = Route::currentRouteName();
        @endphp

        @if (Route::currentRouteName() != 'monitoring.print')
        <div class="navbar navbar-dark bg-dark shadow-sm">
          <div class="container">
            <a href="/monitoring" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Мониторинг</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div> 
        @endif

        @if (Route::currentRouteName() == 'monitoring.index' || Route::currentRouteName() == 'monitoring.search')
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-8 col-sm-10">
          <form name="searchInput" action="{{route('monitoring.search')}}" method="get" class="form-inline form-search pull-right">
            <div class="input-group">
              <input class="form-control" id="searchInput" type="text" name="RFID" placeholder="Найти метку или станок..." style="border-radius: 10px 100px / 120px; border-width: 0px; margin-right: 5px" required>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-primary" style="border-radius: 50% 20% / 10% 40%; border-width: 0px;">Поиск</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
        @endif
        </header>
        
        <main class="py-4">
          @yield('content')
        </main>
    </div>
  </body>
</html>
