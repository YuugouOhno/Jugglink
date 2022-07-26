<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;

class ToolController extends Controller
{
    public function index(Tool $tool, Request $request)
    {
        $tool = $request['tool'];
        
        return view('tools.index')->with(['tool' => $tool]);
    }
}
