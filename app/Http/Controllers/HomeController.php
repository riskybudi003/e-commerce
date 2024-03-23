<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categorys;

class HomeController extends Controller
{
    public function Home()
    {
        $product = Products::take(6)->get();
        $category = Categorys::all();
        return view('User.Home.home', compact('product', 'category'));
    }

    public function allProduct()
    {
        $product = Products::latest()->filter(request(['search']))->paginate(6);
        $category = Categorys::all();
        return view('User.Home.productAll', compact('product', 'category'));
    }

    public function CategoryProduct($slug)
    {
        $cat_pro = Categorys::where('slug_category', $slug)->first();
        $product = Products::where('id_category', $cat_pro->id)->paginate(6);
        $category = Categorys::all();

        return view('User.Home.category_product', compact('cat_pro', 'product', 'category'));
    }

    public function DetailProduct($slug)
    {
        $product = Products::where('slug', $slug)->first();
        $topProduct = Products::take(3)->get();
        $category = Categorys::all();

        return view('User.Home.detail_product', compact('product', 'topProduct', 'category'));
    }
}
