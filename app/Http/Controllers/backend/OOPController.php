<?php

namespace App\Http\Controllers\backend;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class oop{

      public $id = 5;

      function f_post(){

        // $id = $this->id;
        // $posts = Post::where('id', $id);
        return Post::where('id', '=', 1);

      }

}


class OOPController extends Controller
{

  protected function test(){

    // $posts = Post::where('id', $id);
    // return Post::where('id', '=', 1);

     function post(){

        return "content";
     }


  }

  public function OOP()
 {
     $posts = new oop();

    return $posts->f_post();

  }




}
