<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\CursorPaginator;

class OpztController extends Controller
{
  public function mypage(Request $request) {
    return redirect("index");
  }

  public function diary(Request $request) {
    return view('opzt.diary');
  }

  public function diary_create(Request $request) {
    $param = [
      'user_id' => Auth::user()->id,
      'day' => $request->day,
      'time' => $request->time,
      'curriculum' => $request->curriculum,
      'step' => $request->step,
      'body' => $request->body,
    ];

    $request->validate([
	     'day' => 'required',
	     'time' => 'required',
       'curriculum' => 'required',
       'step' => 'required',
       'body' => 'required',
     ],
     [
       'day.required' => '日付は必須項目です。',
	     'time.required' => '学習時間は必須項目です。',
       'curriculum.required' => 'カリキュラムは必須項目です。',
       'step.required' => 'ステップは必須項目です。',
       'body.required' => '学習内容は必須項目です。',
     ]);

    DB::table('diary')->insert($param);

    DB::select('UPDATE users INNER JOIN
      (SELECT diary.user_id, SUM(time) AS learning_time FROM diary GROUP BY diary.user_id) diary
       ON users.id = diary.user_id
       SET users.learning_time = diary.learning_time');

    $request->session()->regenerateToken();

    return view('opzt.diary');
  }

  public function view(Request $request) {
    $items = DB::table('users')
    ->rightJoin('diary','diary.user_id','=','users.id')
    ->select('users.id as id','name','diary.day as day','time','diary.curriculum as curriculum','diary.step as step','body')
    ->orderBy('diary.day', 'desc')
    ->paginate(5);

    $id = Auth::user()->id;
    $pesonItems = DB::table('users')
    ->rightJoin('diary','diary.user_id','=','users.id')
    ->select('diary.id as diary_id','users.id as id','name','diary.day as day','time','diary.curriculum as curriculum','diary.step as step','body')
    ->where('users.id',$id)
    ->orderBy('diary.day', 'desc')
    ->paginate(5);

    return view('opzt.view',['items' => $items,'pesonItems' => $pesonItems]);
  }

  public function my_view(Request $request) {
    $id = Auth::user()->id;
    $pesonItems = DB::table('users')
    ->rightJoin('diary','diary.user_id','=','users.id')
    ->select('diary.id as diary_id','users.id as id','name','diary.day as day','time','diary.curriculum as curriculum','diary.step as step','body')
    ->where('users.id',$id)
    ->orderBy('diary.day', 'desc')
    ->paginate(5);

    return view('opzt.my_view',['pesonItems' => $pesonItems]);
  }

  public function edit(Request $request) {
    $id = $request->diary_id;

    $param = [
      "day" => $request->day,
      "time" => $request->time,
      "diary.curriculum" => $request->curriculum,
      "step" => $request->step,
      "body" => $request->body,
    ];

    DB::table('users')
    ->rightJoin('diary','diary.user_id','=','users.id')
    ->select('diary.id as diary_id','users.id as id','name','diary.day as day','time','diary.curriculum as curriculum','diary.step as step','body')
    ->where('diary.id',$id)
    ->update($param);
    return redirect('my_view');
  }

  public function del(Request $request) {
    $id = $request->diary_id;

    DB::table('diary')
    ->where('id',$id)->delete();
    return redirect('my_view');
  }

  public function post(Request $request) {
    $items = DB::table('articles')
      ->leftJoin('users','users.id','=','articles.user_id')
      ->leftJoin('comments','articles.id','=','comments.article_id')
      ->select('articles.user_id','articles.body','articles.id','users.account_name as name','articles.id')
      ->selectRaw("COUNT(comments.article_id) as count_articleId")
      ->groupBy('articles.id')
      ->get();

    $myItems = DB::table('articles')
      ->select('body','id')
      ->where('user_id',Auth::user()->id)
      ->get();

    return view('opzt.post',['items' => $items , 'myItems' => $myItems]);
  }

  public function post_del(Request $request) {
    DB::table('articles')
      ->where('id',$request->article_id)
      ->delete();

    return redirect('post');
  }

  public function tweet(Request $request) {
    $param = [
      'body' => $request->body,
      'user_id' => Auth::user()->id,
    ];

    DB::table('articles')->insert($param);
    return redirect('post');
  }


  public function comment(Request $request) {
    $param = [
      'body' => $request->body,
      'user_id' => Auth::user()->id,
      'article_id' => $request->article_id,
    ];

    DB::table('comments')->insert($param);
    return redirect('post');
  }

  public function detail(Request $request) {
    $items = DB::table('articles')
      ->leftJoin('users','users.id','=','articles.user_id')
      ->select('body','articles.id','users.account_name as name')
      ->where('articles.id',$request->article_id)
      ->get();

    $comments = DB::table('comments')
    ->leftJoin('users','users.id','=','comments.user_id')
    ->select('body','article_id','comments.id','users.account_name as name')
    ->where('article_id',$request->article_id)
    ->get();

    $val = ['article_id' => $request->article_id];
    $comments =
      DB::select('select ifnull(comment_id,comments.id) as paid, comments.id, body , article_id, users.account_name as name
                  from comments
                  left join users on users.id = comments.user_id
                  where article_id = :article_id
                  order by paid , comments.id',$val);

    return view("opzt.detail",['items' => $items,'comments' => $comments]);
  }

  public function comment_rep(Request $request) {
    $values = explode(",", $request->id);

    $param = [
      'body' => $request->body,
      'user_id' => Auth::user()->id,
      'article_id' => $values[1],
      'comment_id' => $values[0],
    ];
    DB::table('comments')->insert($param);

    $items = DB::table('articles')
      ->select('body','id')
      ->where('id',$values[1])
      ->get();

    // $comments = DB::table('comments')
    // ->select('body','article_id','id')
    // ->where('article_id',$values[1])
    // ->get();

    $val = ['article_id' => $values[1]];

    $comments =
      DB::select('select ifnull(comment_id,id) as paid, id, body , article_id
                  from comments where article_id = :article_id
                  order by paid , id',$val);

    return view('opzt.detail',['items' => $items,'comments' => $comments]);
  }

  public function account(Request $request) {
    return view('opzt.account');
  }

  public function staff(Request $request) {
    $items = DB::table('users')
    ->leftJoin('diary','diary.user_id','=','users.id')
    ->select('users.id as id','name','belong','learning_time','curriculum','step')
    ->groupBy('users.id')
    ->orderBy('users.id', 'asc')
    ->paginate(15);

    $sum = DB::table('diary')
      ->selectRaw('SUM(time) AS total_time')
      ->where('user_id',Auth::user()->id)
      ->first();


    return view('opzt.staff' , ['items' => $items]);
  }

  public function staff_add(Request $request) {

    $param = [
      "name" => $request->name,
      "account_name" => $request->name,
      "belong" => $request->belong,
      "password" => Hash::make("password"),
    ];

    DB::table('users')->insert($param);
    return redirect('staff');
  }

  public function staff_edit(Request $request) {
    $param =[
      "name" => $request->name,
      "account_name" => $request->name,
      "belong" => $request->belong,
    ];

    DB::table('users')
      ->where('id',$request->id)
      ->update($param);

    return redirect('staff');
  }

  public function staff_del(Request $request) {
    DB::table('users')
      ->where('id',$request->id)
      ->delete();

    return redirect('staff');
  }

  public function name_edit(Request $request) {
    $param = [
      'account_name' => $request->name,
    ];

    DB::table('users')
      ->where('id',Auth::user()->id)
      ->update($param);
    return redirect('account');
  }

  public function password_edit(Request $request) {
    $param = [
      'password' => Hash::make($request->password),
    ];

    DB::table('users')
      ->where('id',Auth::user()->id)
      ->update($param);
    return redirect('account');
  }

  public function getAuth(Request $request)
  {
    $param = ['message' => 'ログインしてください'];
    return view('opzt.auth',$param);
  }

  public function postAuth(Request $request)
  {
    $id = $request->id;
    $password = $request->password;
    if(Auth::attempt(['id' => $id, 'password' => $password])) {
      $msg = 'ログインしました(' . Auth::user()->id .')';

      $id = $request->id;
      $item = DB::table('users')
      ->leftJoin('diary','diary.user_id','=','users.id')
      ->select('users.id as id','name','users.belong','users.learning_time','diary.curriculum',)
      ->where('users.id',$id)
      ->orderBy('diary.day','desc')
      ->first();

      DB::select('UPDATE users INNER JOIN
        (SELECT diary.user_id, SUM(time) AS learning_time FROM diary GROUP BY diary.user_id) diary
         ON users.id = diary.user_id
         SET users.learning_time = diary.learning_time');


      return view('opzt.index',['item' => $item ,'message' => $msg]);
    } else {
      $msg = 'ログインに失敗しました。';
      return view('opzt.auth',['message' => $msg]);
    }
  }

  public function like(Request $request) {

    $result = $request->all();

    if(DB::table('likes')->where('user_id',$request->user_id)->where('article_id',$request->article_id)->exists()) {
      DB::table('likes')
        ->where('user_id',$request->user_id)->where('article_id',$request->article_id)
        ->delete();
    } else {
      DB::table('likes')->insert($result);
    }

    return $result;
  }
}
