<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }


    public function index(Product $product)
    {
        $productss = $product->with('offers')->get();
        return view('products.index', compact('productss'));
    }

    public function show(Product $product)
    {
        return view('products.show');
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = public_path('uploads');

            $file->move($path, $filename);

            $imageURL = url('uploads/' . $filename);
        }
        $sellerId = session('user.id');
        if (!$sellerId) {
            return response()->json(['error' => 'seller ID is required'], 400);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageURL,
            'seller_id' =>  $sellerId,
        ]);


        return view('products.index',compact('product'));
    }
}
