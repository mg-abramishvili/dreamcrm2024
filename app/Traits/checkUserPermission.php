<?php

namespace App\Traits;

trait checkUserPermission
{
    public function checkUserPermission($permission)
    {
        $user = request()->user();

        if($user->permissions && $user->permissions[$permission]) {
            return true;
        }

        return false;
    }
}