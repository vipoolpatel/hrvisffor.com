<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobWelfareModel extends Model
{
    protected $table = 'job_welfare';

    public function getwelfare() {

        return $this->belongsTo('App\WelfareModel', 'welfare_id', 'id');
        
    }
}
