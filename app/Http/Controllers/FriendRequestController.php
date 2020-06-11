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

        if (auth()->user()->friends->where('id', $request->user_id)->count()) {
            return response()->json([
                'message' => 'Этот пользователь уже есть в списке Ваших друзей'
            ]);
        }

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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(FriendRequest $friendRequest)
    {
        if (auth()->user()->incomingRequests->where('id', $friendRequest->id)->count()) {
            $friendRequest->delete();
            return response()->json([
                'message' => 'Заявка отклонена'
            ]);
        }
        else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
