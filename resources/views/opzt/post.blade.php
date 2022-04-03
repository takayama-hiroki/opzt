@extends('layouts.opzt')

@section('title','投稿ページ')

@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/css/post.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('js')
  <script type="text/javascript" src="{{ asset('/assets/js/post.js') }}"></script>
@endsection

@section('content')
  <div class="post_nav tab-area">
    <div class="post_window"><a  href="#">つぶやき</a></div>
    <div class="tab active"><a href="#">投稿</a></div>
    <div class="tab"><a href="#">マイ投稿</a></div>
  </div>
  <div class="post_form">
    <div class="post_wrapper">

      <div class="tab_content show">
        @foreach($items as $item)
        <div class="post_contain">
          <div>
            {{ $item->name }}
          </div>
          <div class="body">
            <p>{{ $item->body }}</p>
          </div>

          <div class="post_items">
            <div class="" style="display:flex;">
              <button type="button" class="comment_window btn modal_date" name="button" value="{{ $item->id }}">
                <i class="fa-regular fa-message"></i>
              </button>
              <p style="margin-left:16px;">{{$item->count_articleId}}</p>
            </div>

            <button type="button" id="bt" class="like_btn" name="button" value="{{ $item->id }}">
              @if(DB::table('likes')->where('user_id',Auth::user()->id)
              ->where('article_id',$item->id)->exists())
                <i class="fa-solid fa-star" ></i>
              @else
                <i class="fa-solid fa-star off"></i>
              @endif
            </button>

            <form class="" name="detail" action="detail" method="post">
              @csrf
              <input type="submit" name="" value="詳細">
              <input type="hidden" name="article_id" value="{{$item->id}}">
            </form>
          </div>
        </div>
        @endforeach
        <script type="text/javascript">
        $(function() {
            $('.like_btn').on('click', function() {
              var id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },//Headersを書き忘れるとエラーになる
                    url: '/like',//ご自身のweb.phpのURLに合わせる
                    type: 'POST',//リクエストタイプ
                    dataType: "json",
                    data: {
                      'article_id': id,
                      'user_id': '{{Auth::user()->id}}',
                    },
                })
                // Ajaxリクエスト成功時の処理
                .then((res) => {
                  console.log(res);
                })
                //通信が失敗したとき
                .fail((error) => {
                  console.log(error.statusText);
                });
            });
        });
        </script>

        <!-- @for($i = 0; $i < count($items); $i++)
        <button type="button" id="bt" class="like_btn" name="button" value="{{ $items[$i]->id }}">
          @if(DB::table('likes')->where('user_id',Auth::user()->id)
          ->where('article_id',$items[$i]->id)->exists())
            <i class="fa-solid fa-star" ></i>
          @else
            <i class="fa-solid fa-star off"></i>
          @endif
        </button>

        <script type="text/javascript">
        $(function() {
            $('#bt').on('click', function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },//Headersを書き忘れるとエラーになる
                    url: '/like',//ご自身のweb.phpのURLに合わせる
                    type: 'POST',//リクエストタイプ
                    dataType: "json",
                    data: {
                      'article_id': '{{$items[$i]->id}}',
                      'user_id': '{{Auth::user()->id}}',
                    },
                })
                // Ajaxリクエスト成功時の処理
                .then((res) => {
                  console.log(res);
                })
                //通信が失敗したとき
                .fail((error) => {
                  console.log(error.statusText);
                });
            });
        });
        </script>
        @endfor -->

        <script type="text/javascript">
        $(function(){
          $(".modal_date").on("click",function(){
            event.preventDefault();
            $("#article_id").val($(this).val());
          });
          });
        </script>

        <!-- コメントmodal -->
        <form class="modal_form" method="post" action="comment">
        @csrf
        <div class="comment_process">
          <input class="" type="hidden" name="article_id" id="article_id" value="">
          <h3 class="post_titel">コメント</h3>
          <textarea name="body" rows="6" class="post_text" placeholder="コメントを入力下さい"></textarea>
          <div class="btns">
            <input class="post_btn" type="submit" name="post" value="コメント" id="post">
            <input class="post_btn modal_close" type="button" name="post" value="キャンセル">
          </div>
        </div>
        </form>
      </div>

      <div class="tab_content">
        @foreach($myItems as $myItem)
        <div class="post_contain">
          <p>{{Auth::user()->name}}</p>
          <div class="body">
            <p>{{ $myItem->body }}</p>
          </div>
          <div class="post_items">
            <!-- <div class=""><p>いいね</p></div> -->
            <form class="" name="post_del" action="post_del" method="post">
              @csrf
              <input type="submit" name="" value="削除">
              <input type="hidden" name="article_id" value="{{$myItem->id}}">
            </form>
          </div>
        </div>
        @endforeach
      </div>

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
@endsection
