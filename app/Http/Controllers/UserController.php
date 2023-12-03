<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\checkUserPermission;

class UserController extends Controller
{
    use checkUserPermission;

    public function index()
    {
        if(!$this->checkUserPermission('users_watch'))
        {
            return response('Нет доступа', 500);
        }

        return User::all();
    }

    public function user($id)
    {
        return User::with('permissions')->find($id);
    }
}
