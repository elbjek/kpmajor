<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class ApiCategoriesController extends Controller
{
    public function index ()
    {
        // $categories = Category::with('products')->get();
        $categories = Product::join('categories','categories.id','=','products.category_id')
        ->selectRaw('categories.title as title, categories.id as _id, products.image as image' )
        ->get();
           return response()->json($categories);
    }
    public function show (Category $category)
    {
        // $categories = Category::with('products')->get();
        $product = Product::join('categories','categories.id','=','products.category_id')
        ->join('users','users.id','=','products.user_id')
        ->selectRaw('products.*, categories.title as category_title,users.*, products.id as product_id, users.id as users_id ')
        ->where('products.category_id',$category->id)
        ->get();
           return response()->json($product);
    }
}


