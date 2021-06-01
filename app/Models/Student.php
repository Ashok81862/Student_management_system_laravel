<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
