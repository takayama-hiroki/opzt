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
        <div class="tab1"  style="border-bottom: 1px solid #333;"><a href="view">全体</a></div>
        <div class="tab2"><a href="my_view">個人</a></div>
      </div>

        <table class="content_class">
          <tr>
            <th>名前</th><th>日付</th><th>学習時間</th><th>カリキュラム</th><th>STEP</th><th>取組内容</th>
          </tr>
            @foreach($items as $item)
            <tr>
              <td>{{$item->name}}</td>
              <td>{{$item->day}}</td>
              <td>{{$item->time}}</td>
              <td>{{$item->curriculum}}</td>
              <td>{{$item->step}}</td>
              <td>{{$item->body}}</td>
            </tr>
            @endforeach
        </table>
        {{$items->links()}}
    </div>
  </div>
@endsection
