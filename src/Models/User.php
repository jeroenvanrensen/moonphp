<?php

namespace JeroenvanRensen\MoonPHP\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenvanRensen\MoonPHP\Database\Factories\UserFactory;

class User extends Model
{
    use HasFactory;

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
    public $fillable = [
        'name', 'email', 'password'
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
