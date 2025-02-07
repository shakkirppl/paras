<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherTransactionController extends Controller
{
    //
    public function terms_conditions()
    {
        return view('others.terms-conditions');
    }
    public function privacy_policy()
    {
        return view('others.privacy-policy');
    }
    public function support()
    {
        return view('others.support');
    }
}
