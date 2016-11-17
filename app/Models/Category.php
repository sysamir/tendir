<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property integer $id
 * @property \App\Models\Category $parent
 * @property string $name
 * @property string $icon
 * @property boolean $in_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $children
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereParent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereInOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model {

    public function parent()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent');
    }

    /**
     * Generate id, name list for select box
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePlucky($query)
    {
        return $query->pluck('name', 'id')->all();
    }
}
