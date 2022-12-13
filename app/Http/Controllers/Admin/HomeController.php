<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function TelephonyArea()
    {
        return view('admin.telephony.index');
    }
}
