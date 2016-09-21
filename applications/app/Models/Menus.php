<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_menus';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'directions', 'notes', 'image', 'user_id', 'flag_active', 'menucategory_id'
  ];
}
