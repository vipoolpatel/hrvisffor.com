<?php

namespace App;
use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
class Admin extends Authenticatable
{

    use Notifiable;

    protected $table = 'admins';
    protected $have_role;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    public function OnlineUserAdmin() {
        return Cache::has('OnlineUserAdmin' . $this->id);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
    
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getAdminUserRole();
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfAdminUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfAdminUserHasRole($roles);
        }
        return false;
    }

    public function getAdminUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkIfAdminUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->role_abbreviation)) ? true : false;
    }


    public function printUserImage($width = 0, $height = 0)
    {
        $image = 'no-no-image.gif';
        return \ImgUploader::print_image("user_images/$image", $width, $height, '/admin_assets/no-image.png', $this->name);
    }


    public function countMessages($id)
    {

        return CompanyStaffMessage::where('user_id', '=', $this->id)->where('company_id', '=', $id)->where('status', '=', 'unviewed')->where('type', '=', 'message')->count();

    }



}
