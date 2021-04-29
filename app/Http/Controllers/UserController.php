<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create', ['users' => User::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
           'name' => 'required|min:3',
           'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8|max:64'
        ]);
        $attributes['password'] = Hash::make($request->input('password'));
        User::create($attributes);

        $request->session()->flash('message', 'User Create success');
        $request->session()->flash('class', 'alert alert-success fw-bold');

        return redirect()->route('user.create');
    }

    public function showLoginPage()
    {
        return view('user.login');
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function userLogin(Request $request): RedirectResponse
    {
        $attributes =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)){
            return redirect()->intended('/');
        }
        $request->session()->flash('message', 'Login Failed');
        return back()->withInput(['email']);
    }

    /**
     * @throws \Exception
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();
        $request->session()->flash('message', 'User Delete success');
        $request->session()->flash('class', 'alert alert-danger fw-bold');
        return redirect()->route('user.create');
    }
}
