<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'comment',
        'created_at',
        'updated_at',
    ];

    /**
     * Table relation with User
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Table relation with Post
     *
     * @return BelongsTo
     */
    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
