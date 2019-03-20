<?php

namespace App\Models;

class Card extends Model
{
    public function Series()
    {
        return $this->belongsTo('App\Models\Series');
    }
}
