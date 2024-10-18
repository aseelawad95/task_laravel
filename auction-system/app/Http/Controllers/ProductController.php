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

    
    public function index(Product $product)
{
    $productss = $product->with('offers')->get(); 
    return view('products.index', compact('productss')); 
}

    public function show(Product $product)
    {
        $productss = $product->with('offers')->get();
      //  return $productss;
      return view('welcome');
      //  return view('products.show', compact('productss'));
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
            // Get the file from the request
            $file = $request->file('image');
            
            // Get the original filename with extension
            $filename = time() . '.' . $file->getClientOriginalExtension();
    
            // Define the path to save the image
            $path = public_path('uploads');
    
            // Move the file to the public/uploads directory
            $file->move($path, $filename);
    
            // Image URL
            $imageURL = url('uploads/' . $filename);
        }
        $sellerId = session('user.id');
        if (!$sellerId) {
            return response()->json(['error' => 'Seller ID is required'], 400);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageURL,
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
