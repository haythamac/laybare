<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class UserControlller extends Controller
{
    public function index(){
        $users = User::orderBy('first_name')->orderBy('last_name')->get();

        return view('users.index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username|max:64',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:32',
        ]);

        $user = User::create($validated);
        session()->flash('message', 'User added successfully');

        return redirect()->back();

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'username' => 'required|unique:users,username,'.$user->id.'|max:64',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.'',
        ]);

        $user->update([
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
            'email' => $request->input('email'),
        ]);
        session()->flash('message', 'User updated successfully');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'Category deleted successfully');
        return redirect()->back();
    }
}
