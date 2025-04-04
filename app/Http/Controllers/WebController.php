<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{

   public function website(){
       return view('website.website');
   }

    public function menu(){
         return view('website.menu');
    }

    public function events(){
         return view('website.events');
    }

    public function chefs(){
         return view('website.chefs');
    }
    public function gallery(){
         return view('website.gallery');
    }
     public function contacts(){
     }


     public function about(){
          return view('website.about');

}
}
