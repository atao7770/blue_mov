<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pcmove extends Authenticatable
{

    protected $table = 'pcmov';

    protected $fillable = ['movname', 'movurl', 'picurl', 'torrenturl', 'type'];


}
