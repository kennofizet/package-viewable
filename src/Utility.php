<?php

namespace Package\Kennofizet\Lookview;

use Illuminate\Support\Str;
use Carbon\Carbon;

class Utility
{
    public static function lookViewByUserModelString()
    {
        return config('look_view.look_view_by_user_model', '\Package\Kennofizet\Lookview\Model\LookViewByUser');
    }
    public static function lookViewModelString()
    {
        return config('look_view.look_view_model', '\Package\Kennofizet\Lookview\Model\LookView');
    }
    public static function lookViewUserTokenModelString()
    {
        return config('look_view.look_view_user_token_model', '\Package\Kennofizet\Lookview\Model\LookViewUserToken');
    }

    public static function createTokenId($id_user)
    {
        return Str::random(60) . md5(Carbon::now()) . md5($id_user);
    }
    public static function createToken($id_user)
    {
         return Str::random(100) . md5(Carbon::now()) . md5($id_user);
    }
}
