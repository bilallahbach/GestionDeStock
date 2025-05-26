<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Dashboard extends Controller
{
    public function index()
    {
        $categories = Category::withCount('product')->get();

        $categoryNames = $categories->pluck('name');
        $productCounts = $categories->pluck('products_count');
        $user = User::find(1);

        return view('home', [
            'pic' => $user->avatar,
            'categoriesN' => $categoryNames,
            'productCounts' => $productCounts
        ]);
    }


    public function saveCookie()
    {
        $name = request()->input("txtCookie");
        Cookie::queue("UserName", $name, 6000000);
        return redirect()->back();
    }


    public function saveSession(Request $request)
    {
        $name = $request->input("txtSession");
        $request->session()->put('SessionName', $name);
        return redirect()->back();
    }
    public function saveAvatar()
    {

        request()->validate([
            'avatarFile' => 'required|image',
        ]);
        $ext = request()->avatarFile->getClientOriginalExtension();
        $name = Str::random(30) . time() . "." . $ext;
        request()->avatarFile->move(public_path('storage/avatars'), $name);
        $user = User::find(1);
        $user->update(['avatar' => $name]);
        return redirect()->back();
    }

}
