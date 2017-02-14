<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    /** 
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'downloaded';

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
    protected $fillable = ['song_id'];

    public function song()
    {
        return $this->hasMany('App\Song');
    }
}
