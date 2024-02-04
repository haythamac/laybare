@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product details') }}</div>

                <div class="card-body d-flex flex-column align-items-center ">
                    <img src="/product-img/{{$product->product_image}}" alt="product image" style="height: 256px; width: 256px; margin-bottom: 1rem;">
                    <h4><strong>{{ $product->product_name }}</strong></h4>
                    <h5>{{ $product->product_category }}</h5>
                    <h6>Description: {{ $product->product_description }}</h6>
                    <hr>
                    <hr>
                    <h5>Product SKU: {{ $product->product_sku }}</h5>
                    <h5>Created at: {{ $product->created_at->format('F j, Y H:i:s') }}</h5>
                    <h5>Updated at: {{ $product->updated_at->format('F j, Y H:i:s') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
