<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_reservation';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'handphone', 'size', 'email', 'reserve_date', 'reserve_time', 'specialreq', 'status', 'booking_code', 'user_id', 'branch_id'
  ];
}
