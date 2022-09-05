<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Whoops\Run;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'photo',
        'email_token',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->withDefault(function($data){
            foreach ($data->getFillable() as $dt) {
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function isSuper()
    {
        if( $this->id == 1){
            return true;
        }
        return false;
    }

    public function sectionCheck($value)
    {
        $sections = json_decode($this->role->section, true);
        if (in_array($value, $sections)) {
            return true;
        } else {
            return false;
        }

    }
}
