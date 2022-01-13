<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allFriendshipInverse()
    {
        return $this->belongsToMany(User::class, FriendShip::class, 'user_id', 'friend_id')->wherePivotNull('deleted_at')->withPivot(['id', 'status'])->withTimestamps();
    }

    public function allFriendshipRevarse()
    {
        return $this->belongsToMany(User::class, FriendShip::class, 'friend_id', 'user_id')->wherePivotNull('deleted_at')->withPivot(['id', 'status']);
    }

    public function allFriends()
    {
        return collect(collect($this->allFriendshipInverse)->concat(collect($this->allFriendshipRevarse)));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profile_path()
    {
        return is_null($this->image) ? asset('images/profile_default.png') : asset('storage/' . $this->image);
    }

    public function authorize($id)
    {
        if (auth()->id() != $id) {
            abort(401, 'You can not update this profile!!');
        }
    }

    public function has_friends()
    {
        //retrive all friends data 
        $allfriends_data = $this->allFriends();
        $friends_id = $allfriends_data->pluck('id');
        return $friends_id->contains(auth()->id());
    }
}
