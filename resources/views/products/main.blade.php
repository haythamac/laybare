@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>
                <form action="{{ url('/') }}" method="GET">
                    <div>
                        <select name="filter_category" id="">
                            <option value="all" selected>Show all</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="sort">Sort By:</label>
                    <select name="sort">
                        <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                    <label for="search">Search:</label>
                    <input type="text" name="search" value="{{ $searchTerm }}" placeholder="Enter search term">
                    
                    <button type="submit">Filter</button>
                </form>
                <div>
                    @foreach ($selectedCategory as $category)
                    <div class="mb-4">
                        <h2>{{ $category->category_name }}</h2>

                        <div class="row">
                            @foreach ($productsByCategory[$category->id] as $product)
                            <div class="col-md-3 mb-3">
                                <a href="/show/{{ $product->id }}" style="text-decoration: none;">
                                    <div class="card">
                                        @if ($product->product_image)
                                        <img src="/product-img/{{ $product->product_image }}" alt="product image" style="width: 128px; height: 128px;">
                                        @else
                                        <img src="{{ url('default.jpg') }}" alt="default" style="width: 128px; height: 128px;">
                                        @endif

                                        <div class="card-body">
                                            <p>{{ $product->product_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                            {{ $productsByCategory[$category->id]->appends([$category->id => $productsByCategory[$category->id]])->links() }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection