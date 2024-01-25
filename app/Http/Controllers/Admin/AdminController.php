<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Hash, Session;
use App\Models\Admin;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        Session::put('page', 'dashboard');
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
        Session::put('page', 'update-password');
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_email' => 'required|email',
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

    /**
     * Update admin details 
     * **/

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'update-admin-details');
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            // Get the current admin user
            $adminUser = Auth::guard('admin')->user();

            // Initialize $imageName with the current image value
            $imageName = $adminUser->image;

            $rules = [
                'admin_email' => 'required|email',
                'admin_name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
                'admin_mobile' => 'required|numeric|digits:10',
                'admin_image' => 'image'
            ];

            $customMessage = [
                'admin_name.required' => 'Please provide a name.',
                'admin_name.regex' => 'Please enter only a valid name.',
                'admin_mobile.required' => 'Please provide a mobile number.',
                'admin_mobile.numeric' => 'Please enter a valid phone number.',
                'admin_mobile.digits' => 'Please provide a valid 10-digit phone number.',
                'admin_image.image' => 'Please select a valid image file only',
            ];

            $this->validate($request, $rules, $customMessage);

            // Upload admin image only if a new image is provided
            if ($request->hasFile('admin_image')) {
                $imgTmp = $request->file('admin_image');
                if ($imgTmp->isValid()) {
                    // Generate a unique name for the image
                    $extension = $imgTmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/img/photos/' . $imageName;

                    // Move the uploaded file to the public directory
                    $imgTmp->move(public_path('admin/img/photos'), $imageName);
                }
            }

            // Update the database
            $adminUser->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'], // Ensure to set the mobile field
                'image' => $imageName,
            ]);

            return redirect()->back()->with('success_message', 'Admin Details updated successfully!');
        }

        return view('admin.update_admin_details');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
