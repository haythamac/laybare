@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>First Name</strong></td>
                            <td><strong>Last name</strong></td>
                            <td colspan="2"><strong>Action</strong></td>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td><a href="/users/edit/{{ $user->id }}" style="text-decoration: none; color: green">Edit</a></td>
                            <td>
                                <form id="deleteForm{{ $user->id }}" action="{{ route('delete.user', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="text-decoration: none; color: red; border:none; background: rgba(248,250,252,255);">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <h4>Add user</h4>

                    <form method="post" action="{{ route('add.user') }}" style="margin-bottom: 1rem;">
                        @csrf
                        <input type="text" name="username" placeholder="Username">
                        <input type="text" name="first_name" placeholder="First name">
                        <input type="text" name="middle_name" placeholder="Middle name">
                        <input type="text" name="last_name" placeholder="Last name">
                        <input type="email" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">
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
