<?php

namespace FluentCrud\App\Services;

use FluentCrud\App\Models\User;

class AppHelper
{
    public static function getLoggedInUserInfo($userId = null){
        if ($userId === null) {
            $userId = get_current_user_id();
        }
        if (!$userId) {
            return false;
        }

        return User::find($userId);
    }
}
