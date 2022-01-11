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

    public function friendshipInverse()
    {
        return $this->belongsToMany(User::class, FriendShip::class, 'user_id', 'friend_id')->withPivot('id');
    }

    public function friendshipRevarse()
    {
        return $this->belongsToMany(User::class, FriendShip::class, 'friend_id', 'user_id')->withPivot('id');
    }

    public function friendships()
    {
        return collect($this->friendshipInverse)->concat(collect($this->friendshipRevarse));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function profile_path()
    {
        return is_null($this->image) ? asset('images/profile_default.png') : asset('storage/' . $this->image);
    }
}
