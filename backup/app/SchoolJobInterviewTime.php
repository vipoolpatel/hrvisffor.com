<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 12:47 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SchoolJobInterviewTime extends Model
{
    protected $table = 'school_job_interview_times';
    protected $fillable =[
        'job_id',
        'user_id',
        'invitation_id',
        'date',
        'time',
        'duration',
        'note',
        'is_approve',
        'is_reject',
    ];
}