<?php

namespace App\Models;

use Cache;
use Config;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * App\Models\Admin
 *
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $remember_token
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin whereRoleIs($role = '')
 * @mixin \Eloquent
 */
class Admin extends Authenticatable {

    use LaratrustUserTrait;
    use SoftDeletes;

    protected $with = ['role'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'password'];

    /**
     * Set default crypt password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);

    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
        /*return Cache::remember($cacheKey, Config::get('cache.ttl', 60), function ()
        {
            return $this->roles()->first();
        });*/

    }
}
