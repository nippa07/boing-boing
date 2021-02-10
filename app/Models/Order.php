<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PAYMENT_TYPE = ['PAYPAL' => 1, 'STRIPE' => 2];
    const STATUS = ['PLACED' => 1, 'PAID' => 2, 'FAILED' => 3, 'CANCELED' => 4];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'address',
        'city',
        'country',
        'state',
        'postal_code',
        'notes',
        'status',
        'payment_type',
        'total_amount',
        'transaction_id',
        'quote_id',
        'user_id'
    ];

    public function quote()
    {
        return $this->belongsTo('App\Models\Quote');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getByQuoteId($quote_id)
    {
        return $this->where('quote_id', $quote_id)->first();
    }
}
