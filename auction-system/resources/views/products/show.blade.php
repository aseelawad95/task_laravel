// resources/views/products/show.blade.php
@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

    <h2>Offers</h2>
    <ul>
        @foreach ($offers as $offer)
            <li>Price: {{ $offer->price }} - Buyer: {{ $offer->buyer->name }}</li>
        @endforeach
    </ul>
@endsection
