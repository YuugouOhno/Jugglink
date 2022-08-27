<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\User;
use Auth;

class PlaceController extends Controller
{
    public function index(Place $place)
    {
        return view('maps/index')->with(['place'=>$place->get()]);
    }
    
    public function fetchPlace(Place $place)
    {
        $place = $place->get();
         return response()->json(['place' => $place], 200); // 投稿のデータをvueへ
    }
    public function store(Request $request, Place $place)
    {
        $input_place = $request['place'];
        $input_place += ['user_id' => Auth::id()];
        
        // $input_place += ['tool_name' => Auth::id()->tool->name];
        $place->fill($input_place)->save();
    
        return redirect()->route('map');
    }
    
    public function delete(Place $place, User $user)
    {
        $place->where('user_id', Auth::id())->delete();
        return redirect()->route('map');
    }
}
