<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CommentPost;
use Mail;
class PublicBlogController extends Controller
{
    public function All_Posts()
    {
        //Status 0 == publish
        $posts = Post::with('category')->where('status', 0)->latest()->paginate('8');
        return response()->json($posts, 200);
    }

    public function Public_Blog()
    {
        //Status 0 == publish
        $blogs = Post::with('category')->where('status',0)->get();

        return view('website.pages.blog.blog', compact('blogs'));
    }

    public function Blog_single($slug)
    {
        $blog = Post::with('category')->where('slug', $slug)->first();

         $post_id = $blog->id;

         $comment = CommentPost::with('post')->select("*")
                    ->where('status', 0)
                    ->where('post_id', $post_id)
                    ->get();

         Post::where('slug', $slug)->increment('view_count');

        $category_id = $blog->category_id;


        $related_post = Post::with('category')->select("*")
                    ->where('status', 0)
                    ->where('category_id', $category_id)
                    ->whereNotIn('slug', [$slug])
                    ->limit(4)->get();

        return response()->json([$blog, $related_post, $comment], 200);
    }



    public function search()
    {
        return 'hello';
    }

    public function Mail(Request $request)
    {
        // return $request;

        // $this->validate($request ,[

        //     'name' => 'required|max:10',
        //     'email' => 'required',
        //     'project' => 'required|max:20',

        //    ]);

        $form_data = array(
            'name' =>  $request->name,
            'email' =>  $request->email,
            'project' =>  $request->project
           );

            Mail::send('email.contact', $form_data, function ($message) use ($form_data) {
           //  $message->from('no-reply@laravel.vue.learning', 'New Order Mail');
            $message->to($form_data['email'], $form_data['name']);
            $message->subject('New  From Pappu (Laravel Vue)');
        });
    }


    public function Shorting(Request $request)
    {



         $shorting = $request->shorting;

         if($shorting == '1'){
             // 1 for Popularity
            $posts = Post::select("*")
                    ->where('status', 0)
                    ->where('view_count', '>', 50)
                    ->paginate('4');

            return response()->json($posts, 200);
         }

         else if($shorting == '2'){
             // 3 for Latest
            $posts = Post::select("*")
                    ->where('status', 0)
                    ->latest()->paginate('4');
            return response()->json($posts, 200);
         }

         else if($shorting == '3'){
            // 3 for Oldest
            $posts = Post::select("*")
                    ->where('status', 0)
                    ->oldest()->paginate('4');
            return response()->json($posts, 200);
         }

         else {
             return 'Error';
         }

    }


    public function postsearch($searchdata)
    {
        $posts = Post::select("*")
        ->where('status', 0)
        ->where('title','LIKE','%'.$searchdata.'%')
        ->paginate('4');

        return response()->json($posts,200);
    }
}
