<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//数を数える処理　counts関数を使えば全てのContollerで取得可能
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_movies = $user->movies()->count();//動画の数
        $count_followings = $user->followings()->count();//フォロー中の数
        $count_followers = $user->followers()->count();//フォロワーの数

        return [
            'count_movies' => $count_movies,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
        ];
    }
}
