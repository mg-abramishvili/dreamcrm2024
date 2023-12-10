<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPermission;
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

    public function updatePermissions($user_id, Request $request)
    {
        $userPermissions = UserPermission::where('user_id', $user_id);

        if(isset($request->permission))
        {
            $userPermissions->update([
                $request->permission . '_watch' => $request->can_watch,
                $request->permission . '_create' => $request->can_create,
            ]);
        }
    }
}
