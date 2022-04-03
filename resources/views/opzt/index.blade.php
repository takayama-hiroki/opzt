@extends('layouts.opzt')

@section('title','マイページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
@endsection

@section('content')
<div class="box_contain">

  <div class="box">
    <ul class="staff_date">
      <li>
        <h3>ID</h3>
        <p>{{$item->id}}</p>
      </li>
      <li>
        <h3>名前</h3>
        <p>{{$item->name}}</p>
      </li>
      <li>
        <h3>所属</h3>
        <p>{{$item->belong}}</p>
      </li>
      <li>
        <h3>カリキュラム</h3>
        <p>{{$item->curriculum}}</p>
      </li>
    </ul>
  </div>
  <div class="box learning_time">
    <h3>総学習時間</h3>
    <p>{{$item->learning_time}}時間</p>
  </div>
</div>
@endsection
