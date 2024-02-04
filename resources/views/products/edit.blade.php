@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit product') }}</div>

                <div class="card-body">

                <form class="d-flex flex-column" method="post" action="{{ route('product.update', ['id' => $product->id]) }}" enctype="multipart/form-data" style="margin-bottom: 1rem;">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product name" value="{{ $product->product_name }}"">
                        </div>

                        <div class="mb-3">
                            <label for="product_category_id" class="form-label">Category</label>
                            <select class="form-select" id="product_category_id" name="product_category_id">
                                <option value="" disabled>Select Category</option>
                                <option value="{{ $product->product_category_id }}" selected>{{ $product->product_category }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Created by</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="" selected disabled>Select user</option>
                                <option value="{{ $creator->id }}" selected>{{ $creator->first_name, $creator->last_name }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $category->id }}">{{ $user->first_name, $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label">Description</label>
                            <textarea class="form-control" id="product_description" name="product_description" placeholder="Description" rows="3">{{ $product->product_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="SKU" value="{{ $product->product_sku }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Product Image</label>
                            <img src="/product-img/{{ $product->product_image }}" alt="{{ $product->product_name }} image" style="width: 128px; height: 128px;">
                        </div>

                        <div>
                            <label for="image">Change image</label>
                            <input type="file" name="image" value="{{ $product->image }}" placeholder="Product image">
                        </div>

                        <button type="submit">Submit</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
