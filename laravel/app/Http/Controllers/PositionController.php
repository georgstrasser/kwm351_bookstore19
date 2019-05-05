<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use App\Position;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index(){

        $positions = Position::with(['book'])
            ->get();
        return response()->json($positions, 200);
    }

    private function parseRequest(Request $request) : Request {
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }

}
