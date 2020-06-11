<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use Illuminate\Http\Request;

class FriendsController extends Controller
{

    /**
     * List of user's friends
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'friends' => auth()->user()->friends
        ]);
    }

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
