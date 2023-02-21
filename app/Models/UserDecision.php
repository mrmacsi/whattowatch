<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDecision extends Model
{
    use HasFactory;

    public function show() {
        return $this->hasOne(Show::class,'show_id','show_id');
    }
}
