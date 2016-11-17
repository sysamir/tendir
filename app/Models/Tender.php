<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tender
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_id
 * @property string $name
 * @property string $company_name
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $description
 * @property integer $city_id
 * @property float $price
 * @property boolean $status
 * @property \Carbon\Carbon $expired_at
 * @property \Carbon\Carbon $took_at
 * @property string $activated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $canApply
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereCompanyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereExpiredAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereTookAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereActivatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tender whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tender extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'took_at', 'expired_at'];

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * Can Apply
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function canApply()
    {
        return $this->belongsToMany('App\Models\Company', 'tender_companies');
    }

    /**
     * Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'tender_categories');
    }

    /**
     * Images
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'tender_images');
    }

}
