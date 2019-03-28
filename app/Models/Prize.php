<?php

namespace App\Models;

/**
 * Class Prize
 * @package App\Models
 *
 * @property int $id
 * @property string $photo
 * @property string $name
 * @property string $requirement
 * @property int $limit
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Prize extends Model
{
    public function getRequirementAttribute($requirement)
    {
        return unserialize($requirement);
    }
}
