<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productsByCategory()
    {
        $categories = Category::all();
        $products = collect();
        return view('category.index', compact('categories', 'products'));
    }

    public function getProductsByCategory(Category $category)
    {
        $categories = Category::all();
        $products = $category->product;
        return view('category.index', compact('categories', 'products'));
    }
}
