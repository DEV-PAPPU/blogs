<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('post')->latest()->get();

        // return  $categories->post->count();

        return response()->json($categories, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.post.category.create');
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

        $this->validate($request, [

         'name' =>  'required',

        ]);

        $category = Category::create([

            'name' =>  $request->name,
            'slug' =>  Str::slug($request->name),
        ]);


        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/product/', $image_new_name);
            $category->image = '/storage/product/' . $image_new_name;
            $category->save();
        }

      return response()->json($category, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if($category){
            return response()->json($category, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => "required|unique:categories,name, $category->id"
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function home_Category()
    {
        $categories = Category::latest()->take('2')->get();
        return response()->json($categories, 200);
    }

    public function Category_single($slug)
    {
        // return 'getting ok';
        $category = Category::where('slug', $slug)->get();

        $id = $category[0]->id;

        $posts = Post::with('Category')->where('category_id', $id)->get();
        return response()->json($posts, 200);
    }


    public function Post_Of_Category()
    {
        // return 'getting ok';
        $men_id = 3;
        $women_id = 4;

        // $men = Category::where('id', $men_id)->get();

        // $women = Category::where('id', $women_id)->get();

        $men = Post::with('Category')->where('category_id', $men_id)->get();

        $women = Post::with('Category')->where('category_id', $women_id)->get();

        return response()->json([$men, $women], 200);
    }
}

