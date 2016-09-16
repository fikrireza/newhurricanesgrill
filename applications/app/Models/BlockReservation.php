<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockReservation extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_blockreservation';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'block_date', 'notification', 'user_id', 'branch_id'
  ];

}
