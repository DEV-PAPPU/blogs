<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\CommentPost;

class AdminController extends Controller
{
    function Admin_Home(){
        return view('admin.layouts.master');
    }


    function Admin_Home_Info(){

        $post_count = Post::count();
        $comment_count = CommentPost::count();
        $user_count = User::count();

        return response()->json([$post_count,$comment_count,$user_count], 200);
    }

}
