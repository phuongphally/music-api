<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'albums';

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
    protected $fillable = ['name', 'content', 'url'];

    
}
