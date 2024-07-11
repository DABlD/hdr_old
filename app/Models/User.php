<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\UserAttribute;
use Laravel\Sanctum\HasApiTokens;

use Hash;

class User extends Authenticatable
{
    use SoftDeletes, UserAttribute, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role', 'fname', 'mname', 
        'lname', 'email', 'birthday', 
        'gender', 'address', 'contact', 
        'password', 'civil_status',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'birthday'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }
}