@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit category') }}</div>

                <div class="card-body">

                    <form method="post" action="{{ route('category.update', ['id' => $category->id]) }}">
                        @csrf
                        @method('put')
                        <input type="text" name="category_name" placeholder="Category name" value="{{ $category->category_name}}">
                        <input type="text" name="category_description" placeholder="Category description" value="{{ $category->category_description}}">
                        <input type="text" name="product_manager" placeholder="Product Manager" value="{{ $category->product_manager}}">
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
