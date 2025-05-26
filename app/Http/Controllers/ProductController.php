<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier', 'stock'])
            ->when(request('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);

        $categories = Category::all();
        $suppliers = supplier::all();

        if (request()->ajax()) {

            return response()->json([
                'products' => $products->items(),
                'pagination' => [
                    'total' => $products->total(),
                    'per_page' => $products->perPage(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                ]
            ]);
        }

        return view('products.index', compact('products', 'categories', 'suppliers'));
    }

    public function productsByStore(): View
    {
        $stores = Store::all();
        return view('products.by-store', compact('stores'));
    }

    public function getProductsByStore(Store $store)
    {
        $products = Product::with(['category', 'stock'])
            ->whereHas('stock', function($query) use ($store) {
                $query->where('store_id', $store->id);
            })
            ->get();

        return response()->json($products);
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        $product->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
        public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
      
        Excel::import(new ProductImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully.');
    }

    public function print()
    {
        $user = User::find(1); // Get the authenticated user
        $products = Product::with(['category', 'supplier', 'stock'])->get();
        $data = [
            'products' => $products,
            'user' => $user // Pass the user to the view
        ];

        $mpdf = new Mpdf();
        $html = view('products.print_pdf', $data)->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('products.pdf', 'I'); // 'I' for inline display
    }

}
