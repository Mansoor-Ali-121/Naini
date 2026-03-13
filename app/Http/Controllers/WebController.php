<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
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


     // App\Http\Controllers\WebController.php

     public function itemDetail($slug)
     {
          // 1. Specific item fetch karein slug se (with relationships)
          $menuItem = Menu::with(['category', 'subcategory'])
               ->where('actual_slug', $slug)
               ->firstOrFail();

          // 2. Usi sub-category ke dusre items (Related Items)
          $relatedItems = Menu::where('subcategory_id', $menuItem->subcategory_id)
               ->where('id', '!=', $menuItem->id)
               ->take(4)
               ->get();

          return view('website.item_details', compact('menuItem', 'relatedItems'));
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
