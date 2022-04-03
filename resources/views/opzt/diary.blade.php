@extends('layouts.opzt')

@section('title','日記ページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/diary.css') }}">
@endsection

@section('content')
  <form class="diary_form" action="/diary" method="post">
    @csrf

    @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
    @elseif(isset($_REQUEST['submit']))
      <script>
          alert("送信しました");
      </script>
	  @endif

    <ul>
      <!-- @if($errors->has('day'))
			@foreach($errors->get('day') as $message)
				{{ $message }}<br>
			@endforeach
		  @endif -->
      <li>
        <h3>日付け</h3>
        <input type="date" name="day" value="">
      </li>
      <li>
        <h3>学習時間</h3>
        <input type="text" name="time" value=""><span>時間</span>
      </li>
      <li>
        <h3>取組カリキュラム</h3>
        <select class="" name="curriculum">
          <option value="コーディング基礎">コーディング基礎</option>
          <option value="javascript/jQuery">javascript/jQuery</option>
          <option value="コーディング応用">コーディング応用</option>
          <option value="PHP基礎/アルゴリズム">PHP基礎/アルゴリズム</option>
          <option value="DB基礎">DB基礎</option>
          <option value="PHP応用">PHP応用</option>
          <option value="PHP自作">PHP自作</option>
          <option value="Linux基礎/フレームワーク">Linux基礎/フレームワーク</option>
        </select>
      </li>
      <li>
        <h3>ステップ</h3>
        <input type="text" name="step" value="">
      </li>
      <li>
        <h3>取組内容</h3>
        <textarea name="body" rows="8" cols="80"></textarea>
      </li>
    </ul>
    <input type="submit" name="submit" value="送信" onclick="clicked()">

  </form>
@endsection
