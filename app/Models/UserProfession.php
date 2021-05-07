<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserProfession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profession_id'
    ];
}