<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    public $table = "kins";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
