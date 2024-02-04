@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Name</strong></td>
                            <td><strong>Description</strong></td>
                            <td colspan="2"><strong>Action</strong></td>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->category_description }}</td>
                            <td><a href="/categories/edit/{{ $category->id }}" style="text-decoration: none; color: green">Edit</a></td>
                            <td>
                                <form id="deleteForm{{ $category->id }}" action="{{ route('category.delete', ['id' => $category->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="text-decoration: none; color: red; border:none; background: rgba(248,250,252,255);">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <h4>Add category</h4>

                    <form method="post" action="{{ route('category.add') }}" style="margin-bottom: 1rem;">
                        @csrf
                        <input type="text" name="category_name" placeholder="Category name">
                        <input type="text" name="category_description" placeholder="Category description">
                        <input type="text" name="product_manager" placeholder="Product Manager">
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
