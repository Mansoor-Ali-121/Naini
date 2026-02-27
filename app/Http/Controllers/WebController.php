<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WebController extends Controller
{

     public function website()
     {
          return view('website.website');
     }

     public function menu()
     {
          // Professional Nested Loading: Category -> Sub -> Menus
          $categories = Category::with('subcategories.menus')->get();
          return view('website.menu', compact('categories'));
     }

     public function events()
     {
          return view('website.events');
     }

     public function chefs()
     {
          return view('website.chefs');
     }
     public function gallery()
     {
          return view('website.gallery');
     }
     public function contacts() {}


     public function about()
     {
          return view('website.about');
     }
}
