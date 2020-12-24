<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function createCustomer(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:customers|email',
            'title' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "The request failed with errors",
                'errors' => $validator->errors()
            ], 400);
        }

        $customer = new Customer();
        $customer->title = $request->title;
        $customer->email = $request->email;
        $customer->address = $request->address;;
        $customer->save();

        return response()->json($customer);

    }
}
