<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Company
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $user_full_name
 * @property string $user_email
 * @property string $user_profession
 * @property string $user_phone
 * @property string $email
 * @property string $voen
 * @property string $phone
 * @property string $info
 * @property string $logo
 * @property string $location
 * @property float $rating
 * @property string $remember_token
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tender[] $tenders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tender[] $canApply
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUserFullName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUserEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUserProfession($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUserPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereVoen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Company extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * Tenders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders()
    {
        return $this->hasMany('App\Models\Tender');
    }

    /**
     * Can Apply
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function canApply()
    {
        return $this->belongsToMany('App\Models\Tender', 'tender_companies');
    }

    /**
     * Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'company_categories');
    }


    /**
     * Generate Avatar with url
     *
     * @return null|string
     */
    public function getLogoAttribute()
    {
        return $this->attributes['logo'] ? asset('storage/company/' . $this->attributes['logo']) : null;
    }

    public function logo()
    {
        return $this->attributes['logo'] ? asset('storage/company/' . $this->attributes['logo']) : asset('storage/default/avatar.png');
    }

}
