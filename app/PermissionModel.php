<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    
    static public function getpermission()
    {
    	return self::get();
    }

    protected $table = 'permission';
}
