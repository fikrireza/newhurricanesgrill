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
      'times', 'times1', 'times2', 'times3', 'times4', 'times5', 'times6', 'times7', 'times8', 'times9', 'times10', 'times11', 'blockreservation_id'
  ];

}
