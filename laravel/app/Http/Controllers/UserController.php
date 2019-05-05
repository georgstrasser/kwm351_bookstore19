<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $orders = User::with(['orders', 'books'])
            ->get();

        return response()->json($orders, 200);
    }

    public function findUserById($userID) : JsonResponse {
        $order = User::where('id', $userID)
            ->with(['orders', 'books'])
            ->first();
        return response()->json($order, 200);
    }
}
