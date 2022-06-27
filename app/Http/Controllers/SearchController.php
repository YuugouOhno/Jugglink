<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function index_technique()
    {
        return view('searchs/technique');
    }
    
    public function serch_technique()
    {
        $search = Post::query();
        if(isset($request->tool_id)){
            $search->where('tool_id', '=',$request->tool_id);
        }
        if(isset($request->tool_nmber)){
            $search->where('tool_nmber', '=',$request->tool_nmber);
        }
        if(isset($request->start_date)){
            $search->where('start_date', '>=',$request->start_date);
        }
        if(isset($request->end_date)){
            $search->where('start_date', '=<',$request->start_date);
        }
        if(isset($request->keyword) && $request->keyword_type === "or"){
            $keywords = explode(",", $request->keyword);
            $search->where(function ($query) use($keywords) {
                foreach($keywords as $keyword){
                    $query->orWhere('technique_name', 'LIKE',"%$keyword%");
                }
            });
        } elseif(isset($request->keyword)) {
            $keywords = explode(",", $request->keyword);
            foreach($keywords as $keyword){
                $search->where('review', 'LIKE',"%$keyword%");
            }
        }
        // \DB::enableQueryLog();
        $results = $search->get();
        // dd(\DB::getQueryLog());

        $results->count=count($results);
        // クライアントユーザー（is_admin=0）のみを抽出する
        $users=DB::table('users')->where('is_admin', 0)->get();
        return view('kuchikomis/searchResults',['results' => $results,'users'=>$users]);
    }
}
