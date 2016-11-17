<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Appeal
 *
 * @property integer $id
 * @property integer $tender_id
 * @property integer $company_id
 * @property integer $user_id
 * @property boolean $wrote_by
 * @property string $content
 * @property string $price
 * @property string $date
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Tender $tender
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Company $company
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereTenderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereWroteBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appeal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Appeal extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Tender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }

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

}
