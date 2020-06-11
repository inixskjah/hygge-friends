<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestAcceptController extends Controller
{
    /**
     * Accept friend request;
     * Store friends relationship to DB
     *
     * @param Request $request
     * @param FriendRequest $friendRequest
     * @throws \Exception
     */
    public function store(Request $request, FriendRequest $friendRequest)
    {
        if ($request->accepted)
        {
            $friendRequest->accept();
        }
    }
}
