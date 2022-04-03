@extends('layouts.opzt')

@section('title','社員管理ページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/staff.css') }}">
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/assets/js/staff.js') }}"></script>
@endsection


@section('content')
  <table>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>

    <tr>
      <th>ID</th><th>名前</th><th>所属</th><th>学習時間</th><th>カリキュラム</th><th>STEP</th>
    </tr>
    @foreach($items as $item)
    <form class="staff_form" action="staff_edit" method="post" onSubmit="return checkSubmit()">
      @csrf

      <tr>
        <td><input type="text" name="id" value="{{$item->id}}"></td>
        <td><input type="text" name="name" value="{{$item->name}}"></td>
        <td><input type="text" name="belong" value="{{$item->belong}}"></td>
        <td><input type="text" name="learning_time" value="{{$item->learning_time}}"></td>
        <td><input type="text" name="curriculum" value="{{$item->curriculum}}"></td>
        <td><input type="text" name="step" value="{{$item->step}}"></td>
        <td><input type="submit" name="" value="変更" ></td>
    </form>
    <form class="staff_form" action="staff_del" method="post" onSubmit="return delSubmit()">
      @csrf
        <td>
          <input type="submit" name="" value="削除" >
          <input type="hidden" name="id" value="{{$item->id}}">
        </td>
    </form>
      </tr>
    @endforeach
  </table>
  <div class="">
    {{ $items->links() }}
  </div>
@endsection
