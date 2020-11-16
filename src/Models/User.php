<?php

namespace JeroenvanRensen\MoonPHP\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenvanRensen\MoonPHP\Database\Factories\UserFactory;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moon_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \JeroenvanRensen\MoonPHP\Database\Factories\UserFactory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
