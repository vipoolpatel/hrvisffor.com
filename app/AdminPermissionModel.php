<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermissionModel extends Model
{
    protected $table = 'admin_permission';

    static public function get_permission($staff_id) {
    	return self::where('staff_id','=',$staff_id)->get();
    }

}
