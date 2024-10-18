@extends('layouts.app')
@section('title', 'All Products')

@section('content')
    <div id="app">
        <product-component>
        </product-component>
    </div>
    <script>
        import productComponent from "./ProductComponent.vue";
        export default {
            name: 'ProductComponent',
            components: {
                productComponent,
            }
        }
    </script>
@endsection
