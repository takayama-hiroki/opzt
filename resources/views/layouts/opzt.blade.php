<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- InternetExplor用 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 検索エンジン不要 -->
    <meta name="robots" content="noindex,nofollow" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- cssファイル -->
    <link rel="stylesheet" href="{{ asset('/assets/css/base.css') }}">
    @yield('css')
    <!-- jsファイル -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    @yield('js')
  </head>
  <body>
    <!-- header -->
    <header class="g_nav">
      <div class="header_container">
        <p>{{ Auth::user()->account_name }}</p>
        <!-- <div class="staff_icon">
          <img src="" alt="">
        </div> -->
        <ul class="nav_items">
          <li class="nav_item"><a href="index">マイページ</a></li>
          @if(Auth::user()->belong == "管理")
          <li class="nav_item"><a href="staff">社員管理ページ</a></li>
          @else
          <li class="nav_item"><a href="diary">日記ページ</a></li>
          @endif
          <li class="nav_item"><a href="view">閲覧ページ</a></li>
          <li class="nav_item"><a href="post">つぶやき</a></li>
          <li class="nav_item"><a href="account">アカウント変更</a></li>
          <li class="nav_item"><div class="btn logout_btn"><a href="">
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="auth" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </a></div></li>

          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          </a>

        </ul>
      </div>
    </header>
    <!-- main -->
    <main>
      <div class="main_wrapper">
        <h1 class="title">@yield('title')</h1>

        <div class="content">
        @yield('content')
        </div>
      </div>
    </main>

  </body>
</html>
