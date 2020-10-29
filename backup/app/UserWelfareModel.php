<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWelfareModel extends Model
{
    protected $table = 'user_welfare';

    public function getwelfare() {

        return $this->belongsTo('App\WelfareModel', 'welfare_id', 'id');
        
    }


}
