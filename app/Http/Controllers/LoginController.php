<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    // @desc    Load sign-in page
    // @route   GET /login
    public function index(): View
    {
        return view("login.index");
    }

    // @desc    Authenticate user
    // @route   POST /login
    public function store(LoginRequest $req): RedirectResponse
    {
        if (Auth::attempt(['username' => $req->input("username"), 'password' => $req->input("password")])) {
            $req->session()->regenerate();

            return redirect()->route("dashboard")->with("success", __("auth.loginSuccess"));
        }

        return back()->withErrors([
            "username" => "Credentials doesn't match!"
        ])->onlyInput("username");
    }
}
