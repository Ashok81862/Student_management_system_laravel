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

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guardianDetail()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id', 'id');
    }
}
