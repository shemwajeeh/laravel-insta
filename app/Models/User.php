<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    # To get the posts of a user
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    # To get all the followers of a user
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    # To get all the users that the USER is following
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    # TRUE if the Auth user is following the $user
    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        // Auth::user()->id is the follower_id
        // First, GET ALL THE FOLLOWERS of the USER ($this->followers())
        // Then from the array/list, search the logged in user/ AUTH user from the follower column. (where('follower_id', Auth::user()->id))
    }

    # TRUE if the $user is following the Auth user
    public function isFollowingMe()
    {
        return $this->following()->where('following_id', Auth::user()->id)->exists();
    }
}
