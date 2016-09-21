<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Ingredients;
use App\Models\RecipeMenu;

class MenuController extends Controller
{


    public function index()
    {
      $categoryMenu = MenuCategory::get();

      return view('back.pages.menu.index', compact('categoryMenu'));
    }
}
