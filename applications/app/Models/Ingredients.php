<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_ingredients';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'unit', 'user_id'
  ];
}
