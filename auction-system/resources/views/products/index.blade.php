@extends('layouts.app')
@section('title', 'All Products')

@section('content')
    <div id="app">
        <product-component></product-component>
    </div>
@endsection
<script>
    import productComponent from "../components/CreateProduct.vue";

    export default {
        components: {
            productComponent
        }
    };
</script>
