<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 登録画面表示
    public function index()
    {
    return view('user.register');
    }

    // 登録処理
    public function register(UserRegisterPost $request)
    {
        // validate済みのデータの取得
        $datum = $request->validated();
        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);

        // テーブルへのINSERT　対象のテーブルは、users
        DB::table('users')->insert($datum);

        // 登録成功
        $request->session()->flash('front.User_register_success', true);

        // リダイレクト
        return redirect('/');
    }
}
