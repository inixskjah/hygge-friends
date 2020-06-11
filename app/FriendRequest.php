<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FriendRequest extends Model
{

    protected $fillable = [
        'user_from_id',
        'user_to_id'
    ];

    /**
     * Accept this friend request
     *
     * @throws \Exception
     */
    public function accept()
    {
        DB::insert('INSERT INTO friends (`user1_id`, `user2_id`) VALUES (?, ?)', [
            $this->user_from_id,
            $this->user_tom_id,
        ]);

        $this->delete();
    }
}
