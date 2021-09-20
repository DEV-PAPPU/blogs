<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
class TaskController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::latest()->paginate('5');

        return response()->json($task, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $this->validate($request ,[

        'title' => 'required|max:40',
        'status' => 'required',
        'topic' => 'required',
        'detail' => 'required',

       ]);

       $task = Task::Create([
           'title' => $request->title,
           'status' => $request->status,
           'topic' => $request->topic,
           'detail' => $request->detail,

       ]);

       return response()->json($task, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $id)
    {
        $task = $id;
        return response()->json($task, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $id)
    {
        $task = $id;
        return response()->json($task, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $task =  Task::findOrFail($id);

        $task->update([
           'title' => $request->title,
           'status' => $request->status,
           'topic' => $request->topic,
           'detail' => $request->detail,
        ]);

        return response()->json($task, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json($task, 200);
    }

    public function session_store(Request $request)
    {
        $id = $request->id; // Getting product id

        $cart = Session::get('newcart');

        // if cart is empty then this the first product
        if(!$cart){
              $cart = [

                 $id => [
                     "name" => $request->title,
                     "qty" => 1
                 ]

              ];
          }

          // if cart not empty then check if this product exist then increment quantity

            if(isset($cart[$id])){

                $qty =  $cart[$id]['qty'];

                $res = $qty++;

                return $res;

            }


            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $request->title,
                "qty" => 1
            ];


          Session::put('newcart', $cart);
          return $cart;
    }

}
