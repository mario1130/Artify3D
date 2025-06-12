<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    protected $fillable = ['comment_id', 'user_id', 'reason'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
