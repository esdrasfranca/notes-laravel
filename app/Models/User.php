<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
