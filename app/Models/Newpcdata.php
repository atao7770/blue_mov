<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Newpcdata extends Authenticatable
{

    protected $table = 'newpcdata';

    protected $fillable = ['movname', 'movurl', 'picurl1', 'picurl2','picurl3','picurl4','picurl5','torrenturl', 'type', 'star'];


    const UPDATED_AT = null;


}
