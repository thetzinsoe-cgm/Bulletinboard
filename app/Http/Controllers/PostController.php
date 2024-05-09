<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * show post List
     * @return view
     */
    public function postList()
    {
        return view('post.postList');
    }
}
