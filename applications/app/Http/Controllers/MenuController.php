<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Ingredients;
use App\Models\RecipeMenu;
use Auth;
use Validator;


class MenuController extends Controller
{


    public function index()
    {
      $categoryMenus = MenuCategory::where('flag_active', 1)->get();
      $menus  = Menus::get();

      return view('back.pages.menu.index', compact('categoryMenus', 'menus'));
    }


    public function createCategory(Request $request)
    {
      $message = [
        'name.required' => 'Fill This Field',
        'name.unique' => 'This Category Already Exsist'
      ];

      $validator = Validator::make($request->all(), [
        'name'  => 'required|unique:fra_menucategory',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('menu.index')->withErrors($validator)->withInput();
      }

      $categoryMenu = new MenuCategory;
      $categoryMenu->name = $request->name;
      $categoryMenu->user_id  = $request->user_id;
      $categoryMenu->flag_active = 1;
      $categoryMenu->save();

      return redirect()->route('menu.index')->with('success','New Category Menu Has Been Created');
    }

    public function categoryBind($id)
    {
      $bindCategory = MenuCategory::find($id);

      return $bindCategory;
    }

    public function categoryUpdate(Request $request)
    {
      $categoryUpdate = MenuCategory::find($request->editId);
      $categoryUpdate->name = $request->editName;
      $categoryUpdate->user_id  = $request->editUser_id;
      $categoryUpdate->flag_active  = 1;
      $categoryUpdate->save();

      return redirect()->route('menu.index')->with('success','Category Menu Has Been Updated');
    }

    public function categoryTrash($id)
    {
      $user = Auth::user()->id;

      $trash = MenuCategory::find($id);
      $trash->flag_active = 0;
      $trash->user_id = $user;
      $trash->save();

      return redirect()->route('menu.index')->with('success','Category Successfully Removed');
    }
}
