@extends('layouts.app')



@section('content')

@foreach($productss as $p)
   <div>
     <h1 style="color: black">{{ $p->name }}</h1>
    <p>{{ $p->description }}</p>
    <img src="{{ asset( $p->image) }}" alt="{{ $p->name }}">

   </div>
@endforeach


@php
$i = 0; // Initialize counter
@endphp

<h2>Offers</h2>
<ul>
@foreach ($productss[$i]->offers as $offer)
    @if ($i >= count($productss)) // Limit the number of offers displayed
        @break // Exit the loop if the limit is reached
    @endif
    <li>{{ $offer['price'] }}----{{$offer['buyer_id']}} -</li>
    @php
        $i++; // Increment the counter
    @endphp
@endforeach
</ul>
@endsection
