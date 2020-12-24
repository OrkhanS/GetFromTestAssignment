<?php

namespace App\Http\Controllers;

use App\Jobs\WebSiteHook;
use Auth;
use App\Models\Order;
use App\Models\Customer;
use App\Jobs\SendEmailJob;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Object_;

class OrderController extends Controller
{

    public function createOrder(Request $request, $customer_id): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'totalprice' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "The request failed with errors",
                'errors' => $validator->errors()
            ], 400);
        }
        $customer = Customer::where('id', $customer_id)->first();
        if (!$customer) {
            return response()->json(['error' => 'There is no such customer.'], 401);
        }

        $order = new Order();
        $order->name = $request->name;
        $order->description = $request->description;
        $order->totalprice = $request->totalprice;
        $order->user_id = $customer_id;

        $order->save();


//      $details['email'] = $customer->email;
//      dispatch(new SendEmailJob($details));

        dispatch(new WebSiteHook($order->user_id, $order->id, 1, $order->description));
        return response()->json($order);
    }

    public function getOrders(Request $request,$customer_id): \Illuminate\Http\JsonResponse
    {

        if (!$customer_id) {
            return response()->json([
                'message' => "The request failed with errors",
                'errors' => "Please add customer ID"
            ], 422);
        }

        $customer = Customer::where('id', $customer_id)->first();
        if (!$customer) {
            return response()->json(['error' => 'There is no such customer.'], 401);
        }

        $orders = Order::where('user_id', $customer->id)->get();
        return response()->json([
            'customerInfo' => $customer,
            'orders' => $orders
        ]);
    }
}
