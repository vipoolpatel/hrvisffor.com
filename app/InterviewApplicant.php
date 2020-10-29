<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/24/2020
 * Time: 2:55 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class InterviewApplicant extends Model
{
    protected $table ='interview_applicants';
    protected $fillable =[
      'user_id',
        'job_id',
        'type',
        'applied_id',
        'invite_id',
        'interview_room',
        'is_confirm',
        'is_cancel',
        'status',

    ];
}