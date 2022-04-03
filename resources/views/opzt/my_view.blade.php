@extends('layouts.opzt')

@section('title','閲覧ページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/view.css') }}">
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/assets/js/view.js') }}"></script>
@endsection

@section('content')
  <div class="view_form">
    <div class="area">
      <div class="tab_wrapper">
        <div class="tab1"><a href="view">全体</a></div>
        <div class="tab2" style="border-bottom: 1px solid #333;"><a href="my_view">個人</a></div>
      </div>
        <table class="content_class">
          <tr>
            <th>日付</th><th>学習時間</th><th>カリキュラム</th><th>STEP</th><th>取組内容</th>
          </tr>
            @foreach($pesonItems as $pesonItem)
            <tr>
              <form  class=""  method="post" action="edit" onSubmit="return checkSubmit()">
                @csrf
              <td><input type="date" name="day" value="{{$pesonItem->day}}"></td>
              <td><input type="text" name="time" value="{{$pesonItem->time}}"></td>
              <td><input type="text" name="curriculum" value="{{$pesonItem->curriculum}}"></td>
              <td><input type="text" name="step" value="{{$pesonItem->step}}"></td>
              <td><input type="text" name="body" value="{{$pesonItem->body}}"></td>
              <td>
                  <input type="submit" name="edit" value="変更">
                  <input type="hidden" name="diary_id" value="{{$pesonItem->diary_id}}">
              </td>
              </form>
            <td>
              <form class="" action="del" method="post" onSubmit="return delSubmit()">
                @csrf
                <input type="submit" name="del" value="削除">
                <input type="hidden" name="diary_id" value="{{$pesonItem->diary_id}}">
              </form>
            </td>
          </tr>
          @endforeach
        </table>
        {{$pesonItems->links()}}
    </div>
  </div>
@endsection
