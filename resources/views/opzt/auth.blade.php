<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- InternetExplor用 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 検索エンジン不要 -->
    <meta name="robots" content="noindex,nofollow" />
    <title>ログイン画面</title>
    <!-- cssファイル -->
    <link rel="stylesheet" href="{{ asset('/assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/login.css') }}">
    <!-- jsファイル -->
    <script src=""></script>
  </head>
  <body>
    <main>
      <div class="login_wrapper">
        <h2 class="login_title">opzt</h2>
        <div class="login_contain">
          <h3 class="sub_title">ログイン画面</h3>
          <p>{{$message}}</p>
            <form class="login_form" action="/auth" method="post">
              @csrf
              <ul>
                <li>
                  <p>ID</p>
                  <input type="text" name="id" value="">
                </li>

                <li>
                  <p>パスワード</p>
                  <input type="password" name="password" value="">
                </li>
              </ul>

              <input type="submit" name="" value="ログイン">
            </form>
        </div>
      </div>
    </main>
  </body>
</html>
