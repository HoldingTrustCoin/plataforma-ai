<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //return index of all users
    public function index()
    {
        $page_title = 'Users';

        $user_query = User::get();

        
        if (request()->s) {
            $users = User::where('name', 'LIKE', '%' . request()->s . '%')
                ->orWhere('email', 'LIKE', '%' . request()->s . '%')
                ->orWhere('username', 'LIKE', '%' . request()->s . '%')
                ->paginate(site('pagination'));
        } else {
            $users = User::paginate(site('pagination'));
        }






        return view('admin.users.index', compact(
            'page_title',
            'users',
            'user_query'
        ));
    }


    // return a single user
    public function viewUser(Request $request)
    {
        $user = User::withSum('deposits', 'amount')
            ->withSum('withdrawals', 'amount')
            ->withSum('botActivations', 'capital')
            ->withSum('botHistory', 'profit')
            ->withCount('botActivations')
            ->withCount('referredUsers')
            ->find($request->route('id'));
        if (!$user) {
            return redirect(route('admin.users.index'));
        }


        $page_title = $user->name ?? 'View User';

        return view('admin.users.view', compact(
            'page_title',
            'user'
        ));
    }


    // change user status
    public function status(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user) {
            return response()->json(validationError('User not found'), 422);
        }

        $newStatus = $user->status == 1 ? 0 : 1;
        $user->update(['status' => $newStatus]);

        if ($newStatus == 1) {
            return response()->json(['message' => 'User has been reactivated']);
        } else {
            return response()->json(['message' => 'User has been suspended successfully']);
        }
    }


    //Edit user
    public function edit(Request $request)
    {
        $required_fields = json_decode(site('user_fields'));

        $validationRules = [
            'name' => 'two_words',
            'address' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'gender' => '',
            'dob' => '',
            'phone' => '',
        ];

        // Set the required rule for fields in the $required_fields array
        foreach ($required_fields as $field) {
            if (array_key_exists($field, $validationRules)) {
                $validationRules[$field] .= '|required';
            }
        }

        
        if (user($request->route('id'))->email !== $request->email) {
            $validationRules['email'] = 'required|email|unique:users';
        }

        if (user($request->route('id'))->username !== $request->username) {
            $validationRules['username'] = 'required|unique:users|min:3|max:10';
        }

        $request->validate($validationRules);

        //update the user
        $user = User::find($request->route('id'));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['message' => 'Account updated successfully']);
    }

    // Credit-debit user
    public function creditDebit(Request $request)
    {
        // get the user
        $user = user($request->route('id'));
        // validate input
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required',
            'description' => 'required'
        ]);

        $amount = $request->amount;
        $type = $request->type;
        $description = $request->description;
        //credit if credit
        if ($type == 'credit') {
            
            $new_balance = $user->balance + $amount;
            $credit = User::find($user->id);
            $credit->balance = $new_balance;
            $credit->save();
            // log transaction
            recordNewTransaction($amount, $user->id, $type, $description);
            return response()->json(['message' => $user->username . ' has been credited']);
        } elseif ($type == 'debit') {
            // debit the user
            $new_balance = $user->balance - $amount;
            $debit = User::find($user->id);
            $debit->balance = $new_balance;
            $debit->save();
            // log transaction
            recordNewTransaction($amount, $user->id, $type, $description);
            return response()->json(['message' => $user->username . ' has been debited']);
        } else {
            return response()->json(validationError('Action not recognized'), 422);
        }


    }

    // Send Email
    public function sendEmail(Request $request)
    {
    }

    // change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::find($request->route('id'));
        $user->password = Hash::make($request->password);
        $user->save();
        $name = $user->username ?? 'User';
        return response()->json(['message' =>  $name . "'s password has been changed"]);
    }

    // login as user
    public function loginAsUser(Request $request)
    {
        session()->put('user', $request->route('id'));
        session()->put('login.as.user', $request->route('id'));
        return response()->json(['message' => 'Logged in sucessfully']);

    }

    // delete user
    public function delete(Request $request)
    {
        $user_id = $request->route('id');
        $user = User::find($user_id);
        if ($user) {
            // Delete the user
            $user->delete();

    
            // Clear any associated cached data
            Cache::forget('user:' . $user_id);
    
            
            return response()->json(['message' => 'User deleted successfully']);
        } else {
            return response()->json(validationError('Failed to delete user'), 422);
        }
    }
}



