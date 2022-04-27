<?php

namespace Package\Kennofizet\Lookview;

use Illuminate\Support\Str;
use Carbon\Carbon;

class Utility
{
    public static function makeViewJson()
    {
        if(is_array($tagNames) && count($tagNames) == 1) {
            $tagNames = reset($tagNames);
        }

        if(is_string($tagNames)) {
            $tagNames = explode(',', $tagNames);
        } elseif(!is_array($tagNames)) {
            $tagNames = array(null);
        }

        $tagNames = array_map('trim', $tagNames);

        return array_values($tagNames);
    }


    public static function slug($str)
    {
        
    }

    public static function incrementCount($tagString, $tagSlug, $count)
    {
        if($count <= 0) { return; }
        $model = static::tagModelString();

        $tag = $model::where('slug', '=', $tagSlug)->first();

        if(!$tag) {
            $tag = new $model;
            $tag->name = $tagString;
            $tag->slug = $tagSlug;
            $tag->suggest = false;
            $tag->save();
        }

        $tag->count = $tag->count + $count;
        $tag->save();
    }

    public static function decrementCount($tagString, $tagSlug, $count)
    {
        if($count <= 0) { return; }
        $model = static::tagModelString();

        $tag = $model::where('slug', '=', $tagSlug)->first();

        if($tag) {
            $tag->count = $tag->count - $count;
            if($tag->count < 0) {
                $tag->count = 0;
                \Log::warning("The '.$model.' count for `$tag->name` was a negative number. This probably means your data got corrupted. Please assess your code and report an issue if you find one.");
            }
            $tag->save();
        }
    }

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
