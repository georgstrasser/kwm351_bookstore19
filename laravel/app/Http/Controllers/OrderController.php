<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use App\User;
use App\State;
use DateTime;
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
            $order = new Order();
            $order->order_date = new DateTime($request['order_date']);
            //$order->order_date = new DateTime();
            $order->total = $request->total;
            $order->vat = $request->vat;
            $user = User::where('id', $request->user_id)->first();
            $order->user()->associate($user);
            $order->save();

            $state = new State();
            $state->state = "Offen";
            $state->comment = "Automatisch generiert";
            $state->order()->associate($order);
            $state->save();
            $order->states()->save($state);

            if(isset($request['positions']) && is_array($request['positions'])) {
                foreach ($request['positions'] as $p){
                    $order->books()->attach($p['book']['id'], ['quantity' => $p['quantity'], 'price' => $p['price']]);
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

    public function addState(Request $request) : JsonResponse  {
        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try {
            $state = new State();
            $state->state = $request['state'];
            $state->state_date = new DateTime($request['order_date']);
            $state->comment = $request->comment;
            $order = Order::where('id', $request->order_id)->first();
            $state->order()->associate($order);
            $state->save();

            DB::commit();
            // return a vaild http response
            return response()->json($state, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving state failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }

}
