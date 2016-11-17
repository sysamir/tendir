<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialNetwork
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $provider
 * @property string $sid
 * @property string $token
 * @property string $profile_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereSid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereProfileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialNetwork whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SocialNetwork extends Model {

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
