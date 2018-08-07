<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id_user';

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

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            foreach ($this -> roles as $userRole) {
                if($userRole -> rol_key === $role){
                    return true;
                }
            }
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class,'roles_x_users', 'id_user', 'id_rol')->withTimestamps();
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador');
    }
}
