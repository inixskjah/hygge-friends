<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, hasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFriendsAttribute()
    {
        return $this
            ->belongsToMany(User::class, 'friends', 'user1_id', 'user2_id')
            ->get()
            ->merge(
                $this
                    ->belongsToMany(User::class, 'friends', 'user2_id', 'user1_id')
                    ->get()
            );
    }

    /**
     * Incoming friend requests
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingRequests()
    {
        return $this->hasMany(FriendRequest::class,  'user_to_id', 'id');
    }

    /**
     * Outgoing friend requests
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outgoingRequests()
    {
        return $this->hasMany(FriendRequest::class,  'user_from_id', 'id');
    }

}
