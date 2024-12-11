<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReferralController extends Controller

{
    public function index()
    {
        $page_title = 'My Referrals';
        
        return view('user.referrals.index', compact(
            'page_title',
        ));
    }

}
