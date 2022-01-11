<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'description', 'status', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
        // return $this->morphMany(Vote::class, 'voteable');
    }

    public function voteByuser()
    {
        return $this->votes()->where('user_id', auth()->id())->count();
    }

    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->description), $length);
    }

    public function banner_path()
    {
        return is_null($this->image) ? asset('images/banner_default.jpg') : asset('storage/' . $this->image);
    }

    public function scopePublish($query)
    {
        return $query->where('status', true);
    }

    public function scopeCurrentUserPosts($query)
    {
        if (auth()->id() == $this->user_id) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function authorize()
    {
        if (auth()->id() != $this->user_id) {
            abort(401, 'You can not update this post!!');
        }
    }
}
