<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 12:51 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class JobInvitation extends Model
{
    protected $table = 'job_invitations';
    protected $fillable =[
      'job_id' ,
      'user_id',
      'note',
      'status',
      'is_cancel' ,
      'is_approve' ,
      'is_accept' ,
      'is_reject' ,
    ];
}