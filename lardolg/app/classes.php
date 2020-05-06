<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    public function user_id(){
        return $this->id;
    }
}
