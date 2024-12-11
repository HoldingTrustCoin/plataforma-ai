<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //return profile
    public function profile()
    {

        $page_title = 'My Profile';
        return view('admin.profile.index', compact(
            'page_title'
        ));
    }


    //show page for editing profile
    public function editProfile()
    {
        $page_title = 'Edit Profile';

        return view('admin.profile.edit', compact(
            'page_title',
        ));
    }


    //validate profile edit
    public function editProfileValidate(Request $request)
    {
       
        $validationRules = [
            'name' => 'required',
            'email' => 'required'
        ];

        

        $request->validate($validationRules);

        //update the user
        $admin = Admin::find(admin()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return response()->json(['message' => 'Account updated successfully']);

        
    }

    //update password
    public function updatePassword(Request $request)
    {
        $require_strong_password = site('strong_password');
        $request->validate([
            'current_password' => 'required', 
            'password' => [
                'required',
                'confirmed',
                ($require_strong_password == 1 ? 'min:8' : 'min:5'),
                function ($attribute, $value, $fail) use ($require_strong_password) {
                    if ($require_strong_password == 1) {
                        if (!preg_match('/\d/', $value)) {
                            $fail('The password must contain a number');
                        } elseif (!preg_match('/[a-z]/', $value)) {
                            $fail('The password must contain a lowercase');
                        } elseif (!preg_match('/[A-Z]/', $value)) {
                            $fail('The password must contain an uppercase');
                        } elseif (!preg_match('/[\W_]/', $value)) {
                            $fail('The password must contain a symbol');
                        }
                    }
                }
            ],
        ]);

        
        //check to see if the password was used previously
        if (Hash::check($request->password, admin()->password)) {
            return response()->json(validationError('You have used this password before'), 422);
        }

        //check to see if the password was used previously
        if (!Hash::check($request->current_password, admin()->password)) {
            return response()->json(validationError('Your current password is incorrect'), 422);
        }


        //save the password
        $admin = Admin::find(admin()->id);
        $admin->password = Hash::make($request->password);
        $admin->save();

        //notify the user of the password change
        sendPasswordChangedEmail($admin);

        return response()->json(['message' => 'Password updated succesfully']);
    }

    //upload profile picture
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:50000',
        ]);

        //upload
        $image = $request->file('photo');
        $path = 'profile';
        $photo = uploadImage($image, $path);

        $admin = Admin::find(admin()->id);
        $admin->photo = $photo;
        $admin->save();

        return response()->json(['message' => 'Account updated successfully']);
    }
}
