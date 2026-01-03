<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get all users except the authenticated user.
     */
    public function index(): JsonResponse
    {
        $users = User::where('id', '!=', Auth::id())
            ->select('id', 'username')
            ->get();

        return response()->json($users);
    }
}
