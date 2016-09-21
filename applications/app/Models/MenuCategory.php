<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_menucategory';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'user_id', 'flag_active'
  ];
}
