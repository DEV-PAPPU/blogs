<?php

namespace App\Http\Controllers\backend;
use App\Models\Pos;
use App\Models\Product;
use App\Models\PosSellItems;
use App\Http\Controllers\Controller;
Use Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\ApiOperations\Create;
use Stripe\Charge;
use Stripe\Token;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos_data = Pos::with('user')->latest()->paginate('5');
        return response()->json($pos_data, 200);
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
        //  dd($request->all());
         $products = $request[0];
         $form = $request[1];
         $stripe = $request[2];

        //  return $form['payment_method'];
         //Information
         $user_id = $form['user_id'];
         $pay = $form['pay'];
         $due = $form['due'];
         $payment_method = $form['payment_method'];

         $subtotal = $pay + $due;

         $data = "demo data";

         if($payment_method == '3'){

         Stripe::setApiKey('sk_test_51IOM6LDc5UfRHGAPxrZLh4zYCJFdmA9uQxudY8OsVa6TvjNwLayyfFHdNwfmvAks6dZ4EMQHcNYY9AkBijPuPLz000Ot9GzQDm');

         $token = Token::create([
            'card' => [
              'number' => $stripe['cart_number'],
              'exp_month' => $stripe['exp_month'],
              'exp_year' => $stripe['exp_year'],
              'cvc' => $stripe['cvc'],
            //   'address_city' => $data,
            //   'address_country' => $data,
            //   'address_line1' => $data,
            //   'address_line2' => $data,
            //   'address_state' => $data,
            //   'address_zip' => $data,
            //   'name' => $data,
            ],
          ]);

        //   return $token;
          $email = "pappu@gmail.com";
          $customer = Customer::Create([
            'email' => $email,
            'source' => $token
        ]);

         $charge = Charge::Create([
            'customer_id' => $user_id,
            'amount' => $subtotal,
            'currency' => 'usd',
        ]);
         }


          else{
            $pos = Pos::Create([
                'customer_id' => $user_id,
                'pay' => $pay,
                'due' => $due,
                'subtotal' => $subtotal,
                'payment_method' => $payment_method,
            ]);

               foreach($products as $product){
               $pos_sell_items = PosSellItems::Create([
                    'pos_id' => $pos->id,
                    'product_id' => $product['product_id'],
                    'qty' =>  $product['qty'],
                    'price' => $product['price'],
                ]);
            }
          }

           return response()->json([$pos, $pos_sell_items], 200);
        //    return response()->json([$customer, $charge], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function show(Pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pos = Pos::with('user')->where('id', $id)->get();

        $products = PosSellItems::with('product')->where('pos_id', $id)->get();

        return response()->json([$pos, $products], 200);
        // return response()->json($pos, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pos = Pos::Find($id);
        $old_due = $pos->due;
        $old_pay = $pos->pay;
        $pay = $old_pay + $request->pay;

        $subtotal = $old_due + $pay;

        $pos->update([
         'pay' => $pay,
         'due' => $request->due,
         'subtotal' => $subtotal,
         'payment_method' => $request->payment_method,
       ]);

      return response()->json($pos, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $pos = Pos::where('id', $id)->first();
          PosSellItems::where('pos_id', $id)->delete();

          $pos->delete();

          return response()->json(['Delete success'], 200);


    }

    public function Search(Request $request)
    {
        // return 'ok';
        $date_from = $request->date_from;
        $to_date = $request->to_date;
        $customer_id = $request->customer_id;

        if($customer_id == '0'){
        $pos = Pos::with('user')->select("*")
        ->whereBetween('created_at', [$date_from, $to_date])
        ->paginate('5');

        }

      else{
        $pos = Pos::with('user')->select("*")
        ->whereBetween('created_at', [$date_from, $to_date])
        ->where('customer_id', $customer_id)
        ->paginate('5');
      }

        return response()->json($pos, 200);
    }


    public function newupdate($id, Request $request)
    {
      $post = Post::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }

    public function stripteform()
    {
      return view('stripe');
    }
    public function stripe_payment(Request $request)
    {

        Stripe::setApiKey('sk_test_51IOM6LDc5UfRHGAPxrZLh4zYCJFdmA9uQxudY8OsVa6TvjNwLayyfFHdNwfmvAks6dZ4EMQHcNYY9AkBijPuPLz000Ot9GzQDm');

        //Create a charge
          Charge::create ([
                "amount" => 10 * 20,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment of 200 ruppes."
        ]);

    }

    public function session_store(Request $request)
    {
        $id = $request->id; // Getting product id

        $cart = Session::get('postitem');

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

            }


            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $request->title,
                "qty" => 1
            ];

          Session::put('postitem', $cart);
          return $cart;

    }


}
