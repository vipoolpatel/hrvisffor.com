<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSchoolJoinModel extends Model
{
    protected $table = 'user_school_join';


    public function getschool()
    {
        return $this->belongsTo('App\SchoolJoinModel', 'school_join_id', 'id');
    }

}
