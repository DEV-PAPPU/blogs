<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\ProductController;
use Illuminate\Http\Request;
use App\Models\CommentPost;
class PostCommentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_comments = CommentPost::with('post')->latest()->get();

        return response()->json($post_comments, 200);
    }

    public function Show_comments($id)
    {
        return 'ok';
        $post_id = $id;
        $show_post_comments = CommentPost::select('*')
         ->where('post_id', '=', $post_id)
         ->where('status', '=', 0)
         ->get();

         return response()->json($show_post_comments, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.post.CommentPost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ($request->all());

        $this->validate($request ,[

            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'rating' => 'required',

           ]);

           $comment = CommentPost::create([
               'name' => $request->name,
               'email' => $request->email,
               'post_id' => $request->post_id,
               'comment' => $request->comment,
               'rating' => $request->rating,
           ]);

           return response()->json($comment, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentPost  CommentPost
     * @return \Illuminate\Http\Response
     */
    public function show(CommentPost $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentPost  CommentPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentPost $comment)
    {
        if($comment){
            return response()->json($comment, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommentPost  CommentPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentPost $comment)
    {

        $comment->update([
            'status' => $request->status,
        ]);

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentPost  CommentPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentPost $comment)
    {
        if($comment){
            $comment->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
