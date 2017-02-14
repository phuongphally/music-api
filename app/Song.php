<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'songs';

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
    protected $fillable = ['title', 'content', 'url', 'duration', 'album_id', 'artist_id', 'downloaded'];

    
}
