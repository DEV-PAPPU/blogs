<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Auth;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $products = Product::with('category')->latest()->paginate('4');
        return response()->json($products, 200);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $categories = Category::all();
         return response()->json($categories,200);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        //  dd($request->all());

        // return $request;

         $this->validate($request ,[

             'title' => 'required',
             'price' => 'required|integer',
             'category_id' => 'required',
             'description' => 'required',


            ]);

            $product = Product::Create([

                'title' => $request->title,
                'slug' =>  Str::slug($request->title),
                'price' => $request->price,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'category_id' => $request->category_id,
                'description' => $request->description,

            ]);


         if($request->hasFile('image')){
             $image = $request->image;
             $image_new_name = time() . '.' . $image->getClientOriginalExtension();
             $image->move('storage/product/', $image_new_name);
             $product->image = '/storage/product/' . $image_new_name;
             $product->save();
         }

            return response()->json($product, 200);
     }

     /**
      * Display the specified resource.
      *
      * @param  \App\Models\product  $product
      * @return \Illuminate\Http\Response
      */
     public function show(product $product)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\product  $product
      * @return \Illuminate\Http\Response
      */
     public function edit(product $product)
     {
         // $categories = Category::all();
         // return response()->json([$product,$categories,200]);
         if($product){
             return response()->json($product, 200);
         }else {
             return response()->json('failed', 404);
         }
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\product  $product
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, product $product)
     {


        //  dd($request->all());

         $this->validate($request, [

             'title' => 'required',
             'price' => 'required|integer',
             'description' => 'required',

         ]);


         $product->update([
         'title' => $request->title,
         'slug' => Str::slug($request->title),
         'price' => $request->price,
         'status' => $request->status,
         'category_id' => $request->category_id,
         'description' => $request->description,
         ]);

         if($request->hasFile('image')){
             $image = $request->image;
             $image_new_name = time() . '.' . $image->getClientOriginalExtension();
             $image->move('storage/product/', $image_new_name);
             $product->image = '/storage/product/' . $image_new_name;
             $product->save();
         }

            return response()->json($product, 200);

     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\product  $product
      * @return \Illuminate\Http\Response
      */
     public function destroy(product $product)
     {
         if ($product) {
             $productImage = $product->image;
             $imagePath = public_path($productImage);

             if ($productImage && file_exists($imagePath)) {
                 unlink($imagePath);
             }

             $product->delete();
         } else {
             return response()->json('product not found.', 404);
         }
     }
}
