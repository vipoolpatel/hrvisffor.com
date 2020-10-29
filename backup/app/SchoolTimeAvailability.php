<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 11:17 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SchoolTimeAvailability extends Model
{
    protected $table = 'school_time_availabilities';
    protected $fillable =[
        'school_id',
        'date',
        'time',
        'duration',
        'note'
    ];
}