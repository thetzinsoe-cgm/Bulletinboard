<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'flag',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
