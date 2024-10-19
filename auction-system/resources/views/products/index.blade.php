@extends('layouts.app')
@section('title', 'All Products')

@section('content')
<div id="app">
    <productComponent></productComponent>
</div>
<script src= @vite(['resources/css/app.css', 'resources/js/app.js'])></script>

@endsection
