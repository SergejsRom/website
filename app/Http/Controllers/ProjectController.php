<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    function index() {
        $products = DB::table('products')->get();
        return view('index', compact('products'));
    }

    function single_product(Request $request, $id) {

        $product_array = DB::table('products')->where('id', $id)->get();
        return view('single_product', compact('product_array')); 

    }

    function products() {

        $products = DB::table('products')->get();
        return view('products', compact('products'));

    }

    function specific_product(Request $request, $category) {

        $products = DB::table('products')->where('category', $category)->get();
        return view('products', ['products' => $products]);

    }

    function user_orders(){
        if (Auth::check()) {
            $user_orders = DB::table('users')
                        ->rightJoin('orders', 'users.id', '=', 'orders.user_id')
                        ->where('users.id', Auth::id())
                        ->get();
                        return view('user_orders', ['user_orders' => $user_orders]);

                        
        }else {
            return redirect('/');
        }
    }

    function user_order_details(Request $request, $id) {

        if (Auth::check() && $id != null) {
            $details_array = DB::table('order_items')
                            ->where('order_id', $id)
                            ->get();

                    return view('user_order_details', ['details_array' => $details_array, 'order_id' => $id]);
        }

        return redirect('/');
    }

    function search() {

        $products = DB::table('products')->limit(3)->get();
        return view('search', compact('products'));

    }

    function search_result(Request $request) {

        $keyword = $request->input('keyword');
        $products = DB::table('products')->where('name', 'like', '%'.$keyword.'%')->get();

        return view('search', compact('products'));
    }
}
