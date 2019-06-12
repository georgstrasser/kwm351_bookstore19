<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::with(['states', 'books'])
            ->get();
        return response()->json($orders, 200);
    }

    public function findByOrderID($orderID) : JsonResponse {
        $order = Order::where('id', $orderID)
            ->with(['states', 'books'])
            ->first();
        return response()->json($order, 200);
    }

    public function findOrdersByUserID($userID) : JsonResponse {
        $order = Order::where('user_id', $userID)
            ->with(['states', 'books'])
            ->get();
        return response()->json($order, 200);
    }

    public function save(Request $request) : JsonResponse {
        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try{
            $order = Order::create($request->all());
            $order->save();
            $receivedOrder = Order::where('user_id', $request['user_id'])->last();
            $orderId = $receivedOrder['id'];
            if(isset($request['states']) && is_array($request['states'])) {
                foreach ($request['states'] as $s) {
                    $state = State::firstOrNew(['comment' => $s['comment'], 'state' => $s['state'], 'order_id' => $orderId]);
                    $order->states()->save($state);
                }
            }
            if(isset($request['books']) && is_array($request['books'])) {
                foreach ($request['books'] as $b){
                    $book = Book::where('isbn', $b['isbn'])->first();
                    $order->books()->save($book);
                }
            }
            DB::commit();
            $returnableOrder = $order->with(['states', 'books'])->where('id', $order['id'])->first();
            return response()->json($returnableOrder, 201);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json("saving order failed: " . $e->getMessage(), 420);
        }
        return $request;
    }

    private function parseRequest(Request $request) : Request {
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }

}
