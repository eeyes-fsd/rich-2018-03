<?php

namespace App\Models;

/**
 * Class Series
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property double $longitude
 * @property double $latitude
 * @property \Illuminate\Database\Eloquent\Collection $cards
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Series extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }
}
