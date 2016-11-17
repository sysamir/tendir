<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $other_email
 * @property string $password
 * @property string $phone
 * @property string $extra_phone
 * @property string $address
 * @property string $avatar
 * @property string $birthday
 * @property string $professional
 * @property boolean $type
 * @property boolean $gender
 * @property string $remember_token
 * @property \Carbon\Carbon $deleted_at
 * @property string $deletion_reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialNetwork[] $socialNetworks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tender[] $tenders
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFullName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereOtherEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereExtraPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereProfessional($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletionReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable {

    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set default crypt password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);

    }


    /**
     * SocialNetwork Connections
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function socialNetworks()
    {
        return $this->hasMany('App\Models\SocialNetwork');
    }

    /**
     * Tenders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders()
    {
        return $this->hasMany('App\Models\Tender');
    }

    /**
     * Generate Avatar with url
     *
     * @return null|string
     */
    public function getAvatarAttribute()
    {
        return $this->attributes['avatar'] ? asset('storage/user/avatar/' . $this->attributes['avatar']) : null;
    }

    public function avatar()
    {
        return $this->attributes['avatar'] ? asset('storage/user/avatar/' . $this->attributes['avatar']) : asset('storage/default/avatar.png');
    }
}
