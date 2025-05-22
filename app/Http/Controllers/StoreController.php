<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Product;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function q1()
    {
        $orders = Order::select('customers.first_name', 'customers.last_name', 'orders.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->get();
        return view('exercice.q1', data: compact('orders'));
    }

    public function q2()
    {
        $products = Product::select('products.id')
        ->join('order_product','products.id','=','order_product.product_id')
        ->join('orders','order_product.order_id','=','orders.id')
        ->join('customers','orders.customer_id','=','customers.id')
        ->where('customers.first_name','=','Mina')
        ->where('customers.last_name','=','Halvorson')
        ->get();

        $suppliers = supplier::select('suppliers.first_name','suppliers.last_name')
        ->join('products','suppliers.id','=','products.supplier_id')
        ->whereIn('products.id',$products)
        ->get();

        return view('exercice.q2', data: compact('suppliers'));


    }

    public function q3()
    {
        $stocks = collect();
        return view('exercice.q3', compact('stocks'));
    }

    public function q4()
    {
        $stockCounts = Store::select('stores.name',DB::raw('count(stocks.store_id) as total'))
        ->join('stocks','stores.id','=','stocks.store_id')
        ->groupBy('stocks.store_id')
        ->get();
        return view('exercice.q4', compact('stockCounts'));
    }

    public function q5()
    {
        $values = Stock::join('products', 'stocks.product_id', '=', 'products.id')
            ->select('stocks.store_id', DB::raw('SUM(products.price * stocks.quantity_stock) as total_value'))->groupBy('stocks.store_id')->get();
        return view('exercice.q5', compact('values'));
    }

    public function q6()
    {
        $totalS = Store::select('stores.name')
            ->join('stocks','stores.id','=','stocks.store_id')
            ->join('products', 'stocks.product_id', '=', 'products.id')
            ->where('stores.name','=','Serenity Witting')
            ->select('stocks.store_id', DB::raw('SUM(products.price * stocks.quantity_stock) as total_value'))->groupBy('stocks.store_id')
            ->value('total_value');

        $stores = Store::select('stores.name')
            ->join('stocks','stores.id','=','stocks.store_id')
            ->join('products', 'stocks.product_id', '=', 'products.id')
            ->select('stocks.store_id', DB::raw('SUM(products.price * stocks.quantity_stock) as total_value'))->groupBy('stocks.store_id')
            ->havingRaw('total_value' > $totalS)
            ->get();
        return view('exercice.q6', compact('stores','totalS'));
    }
}
