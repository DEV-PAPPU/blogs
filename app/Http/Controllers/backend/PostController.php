<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category','user')->latest()->paginate('5');

        return response()->json($posts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //   return $request->image;
        // return Auth::user()->id;

        $this->validate($request ,[

            'title' => 'required|max:40',
            'category_id' => 'required',
            'description' => 'required',

           ]);

           $user_id = 1;
           $post = Post::Create([
               'title' => $request->title,
               'slug' =>  Str::slug($request->title),
               'category_id' => $request->category_id,
               'user_id' => $user_id,
            //    'user_id' => Auth::user()->id,
               'description' => $request->description,

           ]);


        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
            $post->save();
        }


           return response()->json($post, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());

        $post->update([
            'title' => $request->title,
            'slug' =>  Str::slug($request->title),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // if($request->image){
        //     if(file_exists(public_path($post->image))){ //if have this type of path has exiting
        //         unlink(public_path("{$post->image}")); // have exiting then delete this file
        //     }
        //     $imageName = time().'-'.uniqid().'.'.$request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('storage/post/'),$imageName);
        //     $post->image = '/storage/post/'.$imageName;
        // }

        // $post->save();

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
            $post->save();
        }

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post) {
            $postImage = $post->image;
            $imagePath = public_path($postImage);

            if ($postImage && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $post->delete();
        } else {
            return response()->json('post not found.', 404);
        }
    }



}
