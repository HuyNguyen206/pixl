<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
//        dd(123);
        $request->user()->profile->posts()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }
}
