<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeMenu extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_recipemenu';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'size', 'user_id', 'menu_id', 'ingredients_id'
  ];
}
