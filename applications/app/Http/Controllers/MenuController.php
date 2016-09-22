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


    public function category()
    {
      $categoryMenus = MenuCategory::where('flag_active', 1)->get();
      $menus  = Menus::get();

      return view('back.pages.menu.category', compact('categoryMenus', 'menus'));
    }


    public function categoryCreate(Request $request)
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
        return redirect()->route('menu.category')->withErrors($validator)->withInput();
      }

      $categoryMenu = new MenuCategory;
      $categoryMenu->name = $request->name;
      $categoryMenu->user_id  = $request->user_id;
      $categoryMenu->flag_active = 1;
      $categoryMenu->save();

      return redirect()->route('menu.category')->with('success','New Category Menu Has Been Created');
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

      return redirect()->route('menu.category')->with('success','Category Menu Has Been Updated');
    }

    public function categoryTrash($id)
    {
      $user = Auth::user()->id;

      $trash = MenuCategory::find($id);
      $trash->flag_active = 0;
      $trash->user_id = $user;
      $trash->save();

      return redirect()->route('menu.category')->with('success','Category Successfully Removed');
    }


    public function ingredients()
    {

      $ingredients = Ingredients::get();

      return view('back.pages.menu.ingredients', compact('ingredients'));
    }

    public function ingredientsCreate(Request $request)
    {
      $message  = [
        'name.required' => 'Fill This Field',
        'name.unique'   => 'The Ingredient Has Already Been Taken',
        'unit.required' => 'Fill This Field'
      ];

      $validator = Validator::make($request->all(), [
        'name'  =>  'required|unique:fra_ingredients',
        'unit'  =>  'required',
      ], $message);

      if($validator->fails()){
        return redirect()->route('menu.ingredients')->withErrors($validator)->withInput();
      }

      $createIngredients = new Ingredients;
      $createIngredients->name  = $request->ingredientName;
      $createIngredients->unit  = $request->ingredientUnit;
      $createIngredients->user_id = $request->user_id;
      $createIngredients->save();

      return redirect()->route('menu.ingredients')->with('success', 'New Ingredients Successfully Created');
    }

    public function ingredientsBind($id)
    {
      $ingredients = Ingredients::find($id);

      return $ingredients;
    }

    public function ingredientsUpdate(Request $request)
    {
      $update = Ingredients::find($request->editId);
      $update->name = $request->editName;
      $update->unit = $request->editUnit;
      $update->user_id  = $request->editUser_id;
      $update->save();

      return redirect()->route('menu.ingredients')->with('success', 'Ingredients Has Been Updated');
    }

    public function menus()
    {
      $menus  = Menus::join('fra_menucategory', 'fra_menucategory.id', '=', 'fra_menus.menucategory_id')
                      ->select('fra_menus.*', 'fra_menucategory.name as categoryName')
                      ->where('fra_menus.flag_active', 1)
                      ->get();

      $categoryMenus       = MenuCategory::where('flag_active', 1)->get();

      return view('back.pages.menu.menus', compact('menus', 'categoryMenus'));
    }

    public function menusCreate(Request $request)
    {
      $message  = [
        'name.required' => 'Fill This Field',
        'name.unique' => 'Ingredient Has Already Been Taken',
        'menucategory_id.required' => 'Fill This Field'
      ];

      $validator  = Validator::make($request->all(), [
        'name'  => 'required|unique:fra_menus',
        'menucategory_id' => 'required|not_in:-- Choose --'
      ], $message);

      if($validator->fails()){
        return redirect()->route('menu.menus')->withErrors($validator)->withInput();
      }

      $menusCreate = new Menus;
      $menusCreate->name  = $request->name;
      $menusCreate->menucategory_id = $request->menucategory_id;
      $menusCreate->user_id  = $request->user_id;
      $menusCreate->flag_active = 1;
      $menusCreate->save();

      return redirect()->route('menu.menus')->with('message', 'New Menu Has Been Created, Please Input the Recipe Then');

    }

    public function menusShow($id)
    {

      $menus  = Menus::join('fra_menucategory', 'fra_menucategory.id', '=', 'fra_menus.menucategory_id')
                      ->select('fra_menus.*', 'fra_menucategory.name as category')
                      ->where('fra_menus.id', $id)
                      ->get();

      return view('back.pages.menu.menusshow', compact('menus'));
    }

}
