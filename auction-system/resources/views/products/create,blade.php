<!-- resources/views/products/create-product.blade.php -->
@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Product</h1>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="border p-3 rounded shadow-sm" style="max-width: 500px; margin: auto;">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" required maxlength="200">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="Description" required minlength="50"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" class="form-control-file" id="image" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Create Product</button>
        </form>
    </div>
@endsection
