<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart() {

        return view('cart');
    }

    public function add_to_cart(Request $request) {

        //if we have a cart in session
        if($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            $products_array_ids = array_column($cart, 'id');
            $id = $request->input('id');

            //add product to cart
            if(!in_array($id, $products_array_ids)) {
                
                $name = $request->input('name');
                $image = $request->input('image');
                $price = $request->input('price');
                $sale_price = $request->input('sale_price');
                $quantity = $request->input('quantity');

                if($sale_price != null) {
                    $price_to_charge = $sale_price;

                }else{
                    $price_to_charge = $price;
                }

                $product_array = array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'quantity'=>$quantity,
                            'price'=>$price_to_charge,
                );

                $cart[$id] = $product_array;
                $request->session()->put('cart', $cart);

                //product already in cart
            }else{
                echo "<script>alet('Product is already in the cart');</script>";
            }

            $this->calculateTotalCart($request);

            return redirect('cart');

        //if we do NOT have a cart in session
        }else{
            $cart = array();

                $id = $request->input('id');
                $name = $request->input('name');
                $image = $request->input('image');
                $price = $request->input('price');
                $sale_price = $request->input('sale_price');
                $quantity = $request->input('quantity');

                if($sale_price != null) {
                    $price_to_charge = $sale_price;

                }else{
                    $price_to_charge = $price;
                }

                $product_array = array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'quantity'=>$quantity,
                            'price'=>$price_to_charge,
                );

                $cart[$id] = $product_array;
                $request->session()->put('cart', $cart);

                $this->calculateTotalCart($request);

                return redirect('cart');


        }
    }


    function calculateTotalCart(Request $request) {

        $cart = $request->session()->get('cart');
        $total_price = 0;
        $total_quantity = 0;

        foreach ($cart as $id => $product) {
            $product = $cart[$id];
            $price = $product['price'];
            $quantity = $product['quantity'];

            $total_price = $total_price + ($price * $quantity);

            $total_quantity = $total_quantity + $quantity;
        }

        $request->session()->put('total', $total_price);
        $request->session()->put('quantity', $total_quantity);

    }

    function remove_from_cart(Request $request) {
        
        if ($request->session()->has('cart')) {
            $id = $request->input('id');
            $cart = $request->session()->get('cart');

            //remove the product function unset
            unset($cart[$id]);

            //add cart again, but without removed product
            $request->session()->put('cart', $cart);

            //recalculate total
            $this->calculateTotalCart($request);
        }
        return redirect('cart');
    }

    function edit_product_quantity(Request $request) {

        if ($request->session()->has('cart')) {

            //inputs
            $product_id = $request->input('id');
            $product_quantity = $request->input('quantity');

            if ($request->has('decrease_product_quantity_btn')) {
                $product_quantity = $product_quantity - 1;
            }elseif ($request->has('increase_product_quantity_btn')) {
                $product_quantity = $product_quantity + 1;
            }else {
                
            }

            //remove <=0
            if ($product_quantity <=0) {
                $this->remove_from_cart($request);
            }

            //getting the cart
            $cart = $request->session()->get('cart');

            //check if product is in cart
            if (array_key_exists($product_id, $cart)) {
                $cart[$product_id]['quantity'] = $product_quantity;

                //put back cart to the session
                $request->session()->put('cart', $cart);

                //recalculate total
                $this->calculateTotalCart($request);
            }

        }
        return redirect('cart');

    }

    function checkout() {
        return view ('checkout');
    }


    function place_order(Request $request) {
        if ($request->session()->has('cart')) {

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $city = $request->input('city');
            $address = $request->input('address');

            $cost = $request->session()->get('total');
            $status = 'not paid';
            $date = date('Y-m-d');
            $cart = $request->session()->get('cart');

            if (Auth::check()) {

                //user logged in
                $user_id = Auth::id(); 
            }else {
                $user_id = 0;
            }


            $order_id =  DB::table('orders')->InsertGetId([

                                'name'=> $name,
                                'email'=>$email,
                                'phone'=>$phone,
                                'city'=>$city,
                                'address'=>$address,
                                'cost'=>$cost,
                                'status'=>$status,
                                'date'=>$date,
                                'user_id' =>$user_id

                        ], 'id'); //'id' will show whom belong the order

            foreach ($cart as $id => $product) {
                $product = $cart[$id];
                $product_id = $product['id'];
                $product_name = $product['name'];
                $product_price = $product['price'];
                $product_quantity = $product['quantity'];
                $product_image = $product['image'];

                DB::table('order_items')->insert([

                        'order_id'=>$order_id,
                        'product_id'=>$product_id,
                        'product_name'=>$product_name,
                        'product_price'=>$product_price,
                        'product_quantity'=>$product_quantity,
                        'product_image'=>$product_image,
                        'order_date'=>$date,
                        
                ]);
            }

        $request->session()->put('order_id', $order_id);

        return redirect('payment');

        }else{
            return redirect('/');
        }
    }

}
