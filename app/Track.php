<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    /** 
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tracks';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['artist_id', 'song_id'];

    public function song()
    {
        return $this->hasMany('App\Song');
    }
}
