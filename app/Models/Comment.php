<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'user_id', 'post_id', 'image', 'status'];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(CommentVote::class);
        // return $this->morphMany(Vote::class, 'voteable');
    }

    public function voteByuser()
    {
        return $this->votes()->where('user_id', auth()->id())->count();
    }

    public function image_path()
    {
        return is_null($this->image) ? asset('images/comment_default.jpg') : asset('storage/' . $this->image);
    }

    public function scopePublish($query)
    {
        return $query->where('status', 1);
    }

    public function authorize()
    {
        if (auth()->id() != $this->user_id) {
            abort(401, 'You can not update this post!!');
        }
    }
}
