<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function theme()
    {
        return session('theme');
    }

    public function themeSet(Request $request)
    {
        session([ 'theme' => $request->theme ]);
    }
}
