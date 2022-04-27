<?php

namespace Package\Kennofizet\Lookview\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getDataUserByJwt()
    {
        $user = JWTAuth::user();
        if (!empty($user)) {
            
        }else{
            return [];
        }
        if (JWTAuth::user()->userRole) {
            $user_role = JWTAuth::user()->userRole->role;
        }else{
            $user_role = "";
        }
        return ['user' => $user, 'user_role' => $user_role];
    }

    public function basicUserData()
    {
    	$user = Auth::user();
        if (!empty($user)) {
            
        }else{
            return [];
        }
        if (Auth::user()->userRole) {
            $user_role = Auth::user()->userRole->role;
        }else{
            $user_role = "";
        }
        return ['user' => $user, 'user_role' => $user_role];
    }
}
