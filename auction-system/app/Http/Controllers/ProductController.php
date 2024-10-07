<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function show(Product $product)
    {
        $offers = $product->offers()->with('buyer')->get();
        return view('products.show', [
            'product' => $product,
            'offers' => $offers
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string|min:50',
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $imagePath = $request->file('image')->store('images/products');

        $sellerId = session('user.id');
        if (!$sellerId) {
            return response()->json(['error' => 'Seller ID is required'], 400);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'seller_id' =>  $sellerId,
        ]);

        return redirect('/products');
    }

    public function getOffers(Product $product)
    {
        $offers = $product->offers()->with('buyer')->get();
        return response()->json($offers);
    }
}
