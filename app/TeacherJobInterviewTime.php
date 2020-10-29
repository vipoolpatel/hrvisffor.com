<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 12:46 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TeacherJobInterviewTime extends Model
{
    protected $table ='teacher_job_interview_times';
    protected $fillable =[
        'job_id',
        'apply_id',
        'user_id',
        'date',
        'time',
        'duration',
        'note',
        'is_approve',
        'is_reject',
    ];
}