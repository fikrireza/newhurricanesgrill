<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockReservationDetail extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_blockreservationdetail';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'times', 'blockreservation_id'
  ];

}
