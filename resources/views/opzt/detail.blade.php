@extends('layouts.opzt')

@section('title','投稿詳細ページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/post.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/detail.css') }}">
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/assets/js/post.js') }}"></script>
@endsection

@section('content')

<div class="post_nav tab-area">
  <div class="post_window"><a  href="#">つぶやき</a></div>
</div>
<div class="post_form">
  <div class="post_wrapper">
    <div class="detail_wrapper">
      @foreach($items as $item)
      <div class="post_contain">
        <div>
          {{ $item->name }}
        </div>
        <div class="body">
          <p>{{ $item->body }}</p>
        </div>
        <div class="post_items">
          <!-- <button type="button" class="comment_window btn modal_date" name="button" value="">コメント</button>
          <div class=""><p>いいね</p></div> -->
        </div>
        <div class="border"></div>
      </div>
      @endforeach
        <div class="" style="margin-left: 60px;">
          @foreach($comments as $comment)
          <div class="post_contain">
            <form class="" name="detail" action="comment_detail" method="post">
            @csrf
              <p>返信</p>
              <div>
                {{ $comment->name }}
              </div>
              <div class="body">
                <p>{{ $comment->body }}</p>
              </div>
              <!-- <div class="post_items">
                <button type="button" id="btn" class="comment_window btn modal_date" name="button" value="{{ $comment->id }},{{ $comment->article_id }}">コメント</button>
                <div class=""><p>いいね</p></div>
                <input type="submit" name="" value="詳細">
              </div> -->
              <div class="border"></div>
            </form>
          </div>
          @endforeach
        </div>

      <script type="text/javascript">
      $(function(){
        $(".modal_date").on("click",function(){
          event.preventDefault();
          $("#comment_id").val($(this).val());
          var values=document.getElementById('btn').value.split(',');
        });
        });


      </script>

      <!-- コメントmodal -->
      <form class="modal_form" method="post" action="comment_rep">
      @csrf
      <div class="comment_process">
        <input class="" type="hidden" name="id" id="comment_id" value="">
        <h3 class="post_titel">コメント</h3>
        <textarea name="body" rows="6" class="post_text" placeholder="コメントを入力下さい"></textarea>
        <div class="btns">
          <input class="post_btn" type="submit" name="post" value="コメント" id="post">
          <input class="post_btn modal_close" type="button" name="post" value="キャンセル">
        </div>
      </div>
      </form>


      <!-- modal -->
      <div class="modal"></div>
      <div class="post_process">
        <h3 class="post_titel">つぶやき</h3>
        <form class="modal_form" method="post" action="post">
          @csrf
          <textarea name="body" rows="6" class="post_text" placeholder="内容を入力下さい"></textarea>
          <div class="btns">
            <input class="post_btn" type="submit" name="post" value="投稿" id="post">
            <input class="post_btn modal_close" type="button" name="post" value="キャンセル">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
