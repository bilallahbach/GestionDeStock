<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function index()
    {
        $customers = Customer::with('order')->get();
        return view('orders.index', compact('customers'));
    }
    
    public function index2()
    {
        $customers = Customer::with('order')->get();
        return view('orders.index2', compact('customers'));
    }

public function getCustomerOrders(Customer $customer)
    {

        $orders = $customer->order()->get();
        return response()->json($orders);
    }

    public function getOrderDetails(Order $order)
    {
        $orderS = Order::with('products')->find($order->id);
        return response()->json($orderS);
    }

public function getOrderDetailss($orderId)
{
    $order = Order::with('products')->findOrFail($orderId);

    $orderArray = [
        'id' => $order->id,
        'created_at' => $order->created_at->format('M d, Y'),
        'products' => $order->products->map(function($product) {
            return [
                'name' => $product->name,
                'price' => $product->pivot->price,
                'quantity' => $product->pivot->quantity
            ];
        })->toArray()
    ];

    $html = view('orders._orders_details', ['order' => $orderArray])->render();

    return response()->json(['html' => $html]);
}

public function getCustomerOrderss($customerId)
{
    $orders = Order::where('customer_id', $customerId)->get()->map(function($order) {
        return [
            'id' => $order->id,
            'created_at' => $order->created_at->format('M d, Y'),
        ];
    });

    $html = view('orders._orders', ['orders' => $orders])->render();

    return response()->json(['html' => $html]);
}

public function searchCustomers($searchTerm)
{
    $customers = Customer::where('last_name', 'like', "%$searchTerm%")->get()->map(function($customer) {
        return [
            'id' => $customer->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
        ];
    });

    return response()->json($customers);
}


}
