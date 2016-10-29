<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 29/10/16
 * Time: 09:52
 */
class Post extends Model
{
    public static function getListPost(){
        return self::db()->table('posts')->get();
    }

}