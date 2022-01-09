<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['vote', 'user_id'];
    use HasFactory;

    public function voteable()
    {
        return $this->morphTo();
    }
}
