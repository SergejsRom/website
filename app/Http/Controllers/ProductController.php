<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Intervention\Image\ImageManager;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->sortBy('name');
        return view('products_new.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('products_new.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        if ($request->file('meal_image')) {
            $image = $request->file('meal_image');

            $ext = $image->getClientOriginalExtension();

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $Image = Image::make($image)->pixelate(12);

            $Image->save(public_path().'/images/'.$file);

            // $photo->move(public_path().'/images', $file);

            // $product->image = asset('/images') . '/' . $file;
            $product->image = $file;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->type = $request->type;

        $product->save();
        // Product::create([
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'price' => $request->input('price'),
        //     'sale_price' => $request->input('sale_price'),
        //     'quantity' => $request->input('quantity'),
        //     'category' => $request->input('category'),
        //     'type' => $request->input('type'),
        //     'image' => $request->input('image')
        // ]);
        return redirect()->route('products_new.index')->with('success_message', 'product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $products = Product::first();
        
        return view('products_new.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products_new.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'sale_price' => $request->input('sale_price'),
            'quantity' => $request->input('quantity'),
            'category' => $request->input('category'),
            'type' => $request->input('type'),
            'image' => $request->input('image'),
            'image1' => $request->input('image1'),
            'image2' => $request->input('image2'),
        ]);
        return redirect()->route('products_new.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product ->delete();
        return redirect()->route('products_new.index');
    }
      
}
