<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\Branch;
use App\Models\User;

class BranchController extends Controller
{

    public function index()
    {
      $getBranch = Branch::get();

      return view('back.pages.branch.index', compact('getBranch'));
    }

    public function create()
    {
      return view('back.pages.branch.create');
    }

    public function store(Request $request)
    {
      // dd($request);
      $message = [
        'name.required'         =>  'Fill This Field',
        'address.required'      =>  'Fill This Field',
        'description.required'  =>  'Fill This Field',
        'phone.required'        =>  'Fill This Field',
        'hotline.required'      =>  'Fill This Field',
        'maps.required'         =>  'Fill This Field',
      ];

      $validator  = Validator::make($request->all(), [
        'name'        =>  'required',
        'address'     =>  'required',
        'description' =>  'required',
        'phone'       =>  'required',
        'hotline'     =>  'required',
        'maps'        =>  'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('branch.view')->withErrors($validator)->withInput();
      }

      $branch = new Branch;
      $branch->name   = $request->name;
      $branch->address  = $request->address;
      $branch->description  = $request->description;
      $branch->phone    = $request->phone;
      $branch->hotline  = $request->hotline;
      $branch->maps     = $request->maps;
      $branch->user_id  = $request->user_id;
      $branch->flag_active  = 0;
      $branch->save();

      return redirect()->route('branch')->with('message', 'New Branch Has Been Created and Not Yet Activated');
    }

    public function bind($id)
    {
      $get  = Branch::find($id);
      return $get;
    }

    public function update($id)
    {

    }

    public function nonactive($id)
    {
      $set = Branch::find($id);
      $set->flag_active = 0;
      $set->save();

      return redirect()->route('branch')->with('message', 'The Branch Has Been DeActivated');
    }

    public function active($id)
    {
      $set = Branch::find($id);
      $set->flag_active = 1;
      $set->save();

      return redirect()->route('branch')->with('message', 'The Branch Has Been Activated');
    }
}
