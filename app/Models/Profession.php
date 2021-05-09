<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'user_professions', 'user_id', 'profession_id');
    }
}
