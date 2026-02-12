<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'content',
        'image_path',
        'user_id',
    ];

    /**
     * Relation: An article belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
