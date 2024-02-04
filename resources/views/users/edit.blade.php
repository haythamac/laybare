@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit user') }}</div>

                <div class="card-body">

                    <form method="post" action="{{ route('update.user', ['id' => $user->id]) }}">
                        @csrf
                        @method('put')
                        <input type="text" name="username" placeholder="Username" value="{{ $user->username}}">
                        <input type="text" name="first_name" placeholder="First name" value="{{ $user->first_name}}">
                        <input type="text" name="middle_name" placeholder="Middle name" value="{{ $user->middle_name}}">
                        <input type="text" name="last_name" placeholder="Last name" value="{{ $user->last_name}}">
                        <input type="email" name="email" placeholder="email" value="{{ $user->email}}">
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
