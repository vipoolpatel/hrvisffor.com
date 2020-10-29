<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 11:18 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TeacherTimeAvailability extends Model
{
    protected $table = 'teacher_time_availabilities';
    protected $fillable =[
        'teacher_id',
        'date',
        'time',
        'duration',
        'note'
    ];
}