<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index(Tool $tool)
    {
        return view('tools.index')->with(['posts' => $tool->getByTool()]);
    }
}
