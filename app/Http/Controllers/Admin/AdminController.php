<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Hash;
use App\Models\Admin;

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
                'password' => 'required|max:20|min:6'
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


    /**
     * Update Password
     */

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'current_password' => 'required|max:20|min:6',
                'password' => 'required|confirmed|max:20|min:6',
            ];

            $customMessage = [
                'password.required' => 'New password field is required.',
                'password.max' => 'New password field cannot be larger than 20 characters.',
                'password.min' => 'New password field cannot be smaller than 6 characters.',
                'password.confirmed' => 'New password field confirmation does not match.'

            ];

            $this->validate($request, $rules, $customMessage);
            // check if current password is correct 
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // Check if new password and confirm password matches 
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['password'])]);
                return redirect()->back()->with('success_message', 'Password successfully updated!');
            } else {
                return redirect()->back()->with('error_message', 'your current password is wrong!');
            }
        }
        return view('admin.update_password');
    }

    /**
     * checkCurrentPassword
     */

    public function checkCurrentPassword(Request $request): string
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
