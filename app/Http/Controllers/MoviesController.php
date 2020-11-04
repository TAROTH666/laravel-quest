<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Movie;

class MoviesController extends Controller
{
    public function create()
    {
        $user = \Auth::user();
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        
        $data=[
            'user' => $user,
            'movies' => $movies,
        ];
        
        return view('movies.create', $data);
    }
    
    //投稿機能　URL,コメントの文字数を制限
    public function store(Request $request)
    {

        $this->validate($request,[
            'url' => 'required|max:11',
            'comment' => 'max:36',
        ]);
        //入力されたURL・コメントを動画のそれぞれのカラムに入れ込む
        $request->user()->movies()->create([
            'url' => $request->url,
            'comment' => $request->comment,
        ]);

        return back();//投稿が完了すると直前のページに遷移
    }
    
    //投稿済み動画の削除機能
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (\Auth::id() == $movie->user_id) {
            $movie->delete();
        }

        return back();
    }

}
