<?php

namespace App\Models;


/**
 * Class Card
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $no
 * @property int $series_id
 * @property double $possibility
 * @property int $limit
 * @property int $exist
 * @property \App\Models\Series $series
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Card extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('App\Models\Series');
    }
}
