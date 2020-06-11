<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use App\Http\Requests\FriendRequestRequest;
use Illuminate\Database\QueryException;

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
        try {
            $friendRequest = FriendRequest::create([
                'user_from_id' => auth()->user()->id,
                'user_to_id' => $request->user_id
            ]);

            return response()->json($friendRequest);
        } catch (QueryException $e) {

            return response()->json([
                'message' => 'Вы уже отправляли запрос данному пользователю!'
            ], 400);

        }
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
