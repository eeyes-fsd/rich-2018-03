<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weapp_openid', 'weixin_session_key', 'role',
    ];


    public function cards()
    {
        $cards = DB::table('card_user')->whereNull('deleted_at')->where('user_id', $this->id)->get();
        $data = new Collection();
        foreach ($cards as $card) {
            $card = Card::find($card->card_id);
            $data->add($card);
        }
        return $data;
    }


    public function valid_cards()
    {
        $cards = DB::table('card_user')->whereNull('deleted_at')->where('user_id', $this->id)->where('valid', 1)->get();
        $data = new Collection();
        foreach ($cards as $card) {
            $card = Card::find($card->card_id);
            $data->add($card);
        }
        return $data;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function prizes()
    {
        return $this->belongsToMany('App\Models\Prize')->withPivot(['id', 'key', 'available'])->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}


