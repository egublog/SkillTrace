<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <title>SkillTrace - @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

  <!-- loginのtoggle用 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <!-- devicon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.11.0/devicon.min.css">


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  <!-- reset.css -->
  <link rel="stylesheet" href="/css/myService/reset.css">

  <!-- original -->
  <link rel="stylesheet" href="@yield('css')">


</head>

<body>

  <div id="app">
    <header class="header">
      <div class="inner">

        <div class="header-logo hidden-sp hidden-tab">
          <a href="{{ route('home.home', ['userId' => $myId]) }}"><img src="/img/header-logo.png" alt=""></a>
        </div><!-- /.header-logo -->

        <div class="header-wrap">

          <nav class="header-nav">
            <ul class="header-nav-list">

              <li class="header-nav-item">
                <a href="{{ route('home.home', ['userId' => $myId]) }}">
                  <i class="fas fa-home icon"></i><span class="hidden-sp">ホーム</span>
                </a>
              </li><!-- /.header-nav-item -->

              <li class="header-nav-item">
                <a href="{{ route('searches.index') }}">
                  <i class="fas fa-search icon"></i><span class="hidden-sp">見つける</span>
                </a>
              </li><!-- /.header-nav-item -->

              <li class="header-nav-item">
                <a href="{{ route('activities') }}">
                  <i class="fas fa-bell icon"></i><span class="hidden-sp">通知</span>
                </a>
              </li><!-- /.header-nav-item -->

              <li class="header-nav-item">
                <a href="{{ route('talks.index') }}">
                  <i class="fas fa-comments icon"></i><span class="hidden-sp">トーク</span>
                </a>
              </li><!-- /.header-nav-item -->

              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>

            </ul><!-- /.header-nav-list -->

          </nav><!-- /.header-nav -->

        </div><!-- /.header-wrap -->




      </div><!-- /.inner -->
    </header>
    <!-- /.header -->

    <main>

      @yield('content')

    </main>
  </div><!-- /#app -->


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> -->
  <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>