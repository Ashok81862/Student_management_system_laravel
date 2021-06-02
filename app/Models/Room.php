<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
