<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:20'
            ];

            $customMessage = [
                'email.required' => "Email is required.",
                'email.email' => "Valid email is required.",
                'password.required' => "Password is required",
            ];

            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with("error_message", "Invalid Credentials");
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
