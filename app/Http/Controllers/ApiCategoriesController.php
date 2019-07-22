<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class ApiCategoriesController extends Controller
{
    public function index ()
    {
        $categories = Category::get();
        return response()->json($categories);
    }
}
