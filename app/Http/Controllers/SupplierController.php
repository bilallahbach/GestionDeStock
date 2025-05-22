<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = supplier::latest()->paginate(20);
        return view('suppliers.index', compact('suppliers'));
    }

    public function productsBySupplier(): View
    {
        $suppliers = Supplier::all();
        return view('products.by-supplier', compact('suppliers'));
    }

    public function getProductsBySupplier(Supplier $supplier)
    {

        $products = Product::with(['stock','category'])
        ->where('supplier_id', $supplier->id)
        ->get();
        return view('products._products_by_supplier', compact('products'));
    }
}
