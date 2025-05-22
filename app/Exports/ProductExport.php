<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ProductExport implements FromCollection, WithCustomStartCell,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::join('categories', 'category_id','=' ,'categories.id')
        ->join('suppliers', 'supplier_id','=' ,'suppliers.id')
        ->join('stocks', 'products.id','=','stocks.product_id')
        ->select('products.id', 'products.name','products.description',  'price','stocks.quantity_stock', DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier") , 'categories.name as category')
        ->get();
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['id',
        'name',
        'description',
        'price',
        'stock',
        'category',
        'supplier'];
    }

    public function startCell(): string
    {
        return 'C5';
    }
}
