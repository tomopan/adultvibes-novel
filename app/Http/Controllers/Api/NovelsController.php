<?php

//変更
namespace App\Http\Controllers\Api;

//追記
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Validate;
use DB;

use App\User;
use App\Novel;
use App\Heroe;



    //=======================================================================
    class NovelsController extends Controller
    {

        //小説の一文目を保存
        public function saveFirst(Request $request,$hero_id)
        {
            //ユーザー情報取得
            $userId = Auth::id();
            // $userId = 100;

            //登録する情報を格納
            $novel = new Novel;
            //ユーザー情報を登録
            $novel->user_id = $userId;
            //ペーパー情報を登録
            $novel->hero_id = $hero_id;//主人公id
            $novel->first_sentence = $request->first_sentence;//ファーストセンテンス

            //ペーパーの順序を登録
                //ペーパーの順序を取得
                $user_paper_order = Novel::where('user_id','=',$userId)
                                    ->max('user_paper_order');
                    //既に書かれていたら、numberに+1
                    if($user_paper_order) $user_paper_order += 1;
                    //はじめてのペーパーなら、1を代入
                    else $user_paper_order = 1;

            $novel->user_paper_order = $user_paper_order;//ペーパーオーダー

            $novel->status = 0;//ステータスを0(非公開)
            $novel->save();
            return $novel;
        }

        //hero_idにマッチした、公開されている小説のデータを取得
        public function show($hero_id)
        {
            $novels = DB::table('novels as n')
                    ->join('users as u','u.id','=','n.user_id')
                    ->where('n.hero_id', '=', $hero_id)
                    ->where('n.status', '=', 1)
                    ->select('u.name','n.id','n.hero_id','n.title','n.user_id','n.status','n.first_sentence')
                    ->get();
            // $novels =  Novel::where('hero_id','=',$hero_id)
            //                 ->get();

            return response()->json($novels);
        }

        //novel_idにマッチした小説のデータをひとつだけ取得
        public function fetch($user_paper_order)
        {
            $novel = DB::table('novels as n')
                    ->join('users as u','u.id','=','n.user_id')
                    ->where('n.user_paper_order', '=', $user_paper_order)
                    ->select('u.name','u.id','n.id','n.title','n.user_id','n.status','n.first_sentence')
                    ->first();
            return response()->json($novel);
        }

        //プロフィールページで公開中の小説のデータ取得
        public function showWrited()
        {
            $novels =DB::table('novels as n')
                        ->join('heroes as h','h.id','=','n.hero_id')
                        ->where('n.user_id','=', Auth::id())
                        ->where('n.status',1)
                        ->select('n.id','n.title','n.user_id','n.status','n.hero_id','h.img_url')
                        ->orderBy('n.created_at')
                        ->get();
            return response()->json($novels);
        }
    
        //プロフィールページで非公開の小説のデータ取得
        public function showWriting()
        {
            $novels =DB::table('novels as n')
                        ->join('heroes as h','h.id','=','n.hero_id')
                        ->where('n.user_id','=', Auth::id())
                        ->where('n.status',0)
                        ->select('n.id','n.title','n.user_id','n.status','n.hero_id','h.img_url')
                        ->orderBy('n.created_at')
                        ->get();
            return response()->json($novels);
        }

        //小説のステータスを変更（公開→非公開）
        public function closeNovelStatus($novel_id)
        {
            $novel =  Novel::where('id','=',$novel_id) 
                        ->update(['status' => 0]);
            return $novel;
            // return response()->json($novels);
        }

        //小説のステータスを変更（非公開→公開）
        public function openNovelStatus($novel_id)
        {
            $novel =  Novel::where('id','=',$novel_id) 
                        ->update(['status' => 1]);
            return $novel_id;
            // return response()->json($novels);
        }

        //小説のタイトルを変更
        public function postTitle(Request $request,$novel_id)
        {
            $title =  Novel::where('id','=',$novel_id) 
                        ->update(['title' => $request->title]);
            return $title;
            // return response()->json($novels);
        }
    }
    
