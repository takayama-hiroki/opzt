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
