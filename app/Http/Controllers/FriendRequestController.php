<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use App\Http\Requests\FriendRequestRequest;

class FriendRequestController extends Controller
{

    /**
     * Get list of friends requests
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'incoming_requests' => auth()->user()->incomingRequests,
            'outgoing_requests' => auth()->user()->outgoingRequests,
        ]);
    }

    /**
     * Store friend request to DB
     *
     * @param FriendRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FriendRequestRequest $request)
    {
        $friendRequest = FriendRequest::create([
            'user_from_id' => auth()->user()->id,
            'user_to_id'   => $request->user_id
        ]);

        return response()->json($friendRequest);
    }

    /**
     * Delete friend request from DB (decline request)
     *
     * @param FriendRequest $friendRequest
     * @throws \Exception
     */
    public function destroy(FriendRequest $friendRequest)
    {
        $friendRequest->delete();
    }
}
