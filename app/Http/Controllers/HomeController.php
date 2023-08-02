<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeClient(Request $request){
        $product = Product::all();
        $category = Category::all();
        
        return view('client.home.index', compact('category','product'));

    }

    public function homeAdmin(){

        return view('admin.home.index');

    }
    public function detail($id){
        $category = Category::all();
        $product = product::find($id);
        $products = Product::all();
        // dd($product);
        return view('client.home.product-detail',compact('product','category','products'));
    }
    public function about(Request $request){
        $product = Product::all();
        $category = Category::all();
        
        return view('client.about.index', compact('category','product'));

    }
    public function product(Request $request){
        $products = Product::all();
        $category = Category::all();
        
        return view('client.home.product-all', compact('category','products'));
 
    }

}
