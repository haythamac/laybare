@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Category</td>
                            <td>Description</td>
                            <td>SKU</td>
                            <td>Added by</td>
                            <td>Created on</td>
                            <td colspan="2">Action</td>
                        </tr>
                        @foreach ($products as $product)
                        <tr>
                            @if ($product->product_image == 'default.jpg')
                                <td><img src="{{ url('default.jpg') }}" alt="default" style="width: 128px;"></td>
                            @else
                                <td><img src="/product-img/{{ $product->product_image }}" alt="product image" style="width: 128px;"></td>
                            @endif
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_category }}</td>
                            <td>{{ $product->product_description }}</td>
                            <td>{{ $product->product_sku }}</td>
                            <td>{{ $product->user->first_name. ' ' . $product->user->last_name }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td><a href="/products/edit/{{ $product->id }}" style="text-decoration: none; color: green">Edit</a></td>
                            <td>
                                <form id="deleteForm{{ $product->id }}" action="{{ route('product.delete', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="text-decoration: none; color: red; border:none; background: rgba(248,250,252,255);">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {{ $products->links() }}
                </div>
            </div>

            <div class="card" style="margin-top: 1rem;">
                <div class="card-header">{{ __('Add products') }}</div>

                <div class="card-body">
                    <form class="d-flex flex-column" enctype="multipart/form-data" method="post" action="{{ route('product.add') }}" style="margin-bottom: 1rem;">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product name">
                        </div>

                        <div class="mb-3">
                            <label for="product_category_id" class="form-label">Category</label>
                            <select class="form-select" id="product_category_id" name="product_category_id">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Created by</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="" selected disabled>Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $category->id }}">{{ $user->first_name, $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label">Description</label>
                            <textarea class="form-control" id="product_description" name="product_description" placeholder="Description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="SKU">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
