<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmPayment extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'fra_confirmpayment';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'acc_no', 'acc_name', 'date_payment', 'total_payment', 'notes', 'paymentimg', 'reservation_id'
  ];
}
