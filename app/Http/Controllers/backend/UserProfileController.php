<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Auth;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user_id =  Auth::user()->id;
        $user_posts = Post::with('category')->where('user_id', '=', $auth_user_id)->get();


        // $posts = Post::where('user_id', '=', $auth_user_id)->get();
        // return view('admin.user.allposts', compact('user_posts'));
        return response()->json($user_posts, 200);
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
        // dd($request->all());

        $this->validate($request ,[

            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',

           ]);

           $pending = 1;

           $post = Post::Create([
               'title' => $request->title,
               'slug' =>  Str::slug($request->title),
               'user_id' => Auth::user()->id,
               'category_id' => $request->category_id,
               'description' => $request->description,
               'status' => $pending,

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


        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/product/', $image_new_name);
            $post->image = '/storage/product/' . $image_new_name;
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


  public function User_Orders(){

    $user_id = Auth::user()->id;

    $user_orders = Order::where('user_id', '=' , $user_id)->get();

    return response()->json($user_orders, 200);

  }


  public function User_single_Order(){

    $order_items = OrderItems::where('order_id','=',$user_order_id)->get();

    return response()->json([$user_order_id, $order_items], 200);

  }


  public function Auth_User_Data(){

    $user = Auth::user();
    return response()->json($user, 200);

  }
}
