@extends('layouts.opzt')

@section('title','アカウント変更')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/account.css') }}">
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/assets/js/account.js') }}"></script>
@endsection

@section('content')
  <div class="account_wrapper">
    <form class="account_form" action="" method="post" onSubmit="return checkSubmit()">
      @csrf
      <ul>
        <li>
          <h3>アカウント名</h3>
          <input type="text" name="name" value="{{Auth::user()->account_name}}">
          <input type="submit" name="" value="変更" formaction="name_edit">
        </li>

        <li>
          <h3>パスワード</h3>
          <input type="password" name="password" value="">
          <input type="submit" name="" value="変更" formaction="password_edit">
        </li>
      </ul>
    </form>
  </div>
@endsection
