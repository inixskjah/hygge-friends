<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{

    /**
     * Get list of all app users
     *
     * @return \Illuminate\Http\JsonResponse]
     */
    public function index()
    {
        return response()->json([
            'users' => User::all()
        ]);
    }
}
