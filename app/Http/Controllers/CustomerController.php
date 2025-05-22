<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::query()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create(){
        return view('customers.create');
    }
    public function store(StorePostRequest $request)
        {
            // La validation est déjà gérée par StorePostRequest
            
            // Création du post
            Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            
            // Redirection avec message de succès
            return redirect()->route('customers.index')
                ->with('success', 'Customer a été créé avec succès!');
        }
        public function edit(Customer $customers)
        {
            return view('customers.edit', compact('customers'));
        }
        
        public function update(StorePostRequest $request, Customer $customers)
        {
            $customers->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            
            return redirect()->route('customers.index', $customers)
                ->with('success', 'Customer a été modifié avec succès!');
        }
        public function destroy(Customer $customers)
        {
            // Suppression du post
            $customers->delete();
            
            // Redirection avec message de succès
            return redirect()->route('customers.index')
                ->with('success', 'Customer a été supprimé avec succès!');
        }
        public function searchTerm(Request $request, $term)
            {

                $customers = Customer::where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('address', 'like', "%{$term}%")
                    ->get();

                return response()->json($customers);
            }
  /**
     * Search for customers by name, email, phone or address.
     */
    public function search(Request $request)
    {
        $term = $request->input('term');
                $customers = Customer::where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('address', 'like', "%{$term}%")
                    ->paginate(10);

                return response()->json([
                    'customers' => $customers->items(),
                    'pagination' => [
                        'total' => $customers->total(),
                        'per_page' => $customers->perPage(),
                        'current_page' => $customers->currentPage(),
                        'last_page' => $customers->lastPage(),
                        'from' => $customers->firstItem(),
                        'to' => $customers->lastItem(),
                        'links' => $customers->linkCollection()->toArray()
                    ]
                ]);
    }
}
