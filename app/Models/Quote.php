<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    const STATUS = ['SENT' => 1, 'ACCEPTED' => 2, 'DECLINED' => 3];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quote_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'vat_number',
        'address',
        'city',
        'country',
        'state',
        'postal_code',
        'status',
        'quote_request_id'
    ];

    public function quote_item()
    {
        return $this->hasMany('App\Models\QuoteItem', 'quote_id');
    }

    public function getQuoteByQuoteNumber($quote_number)
    {
        return $this->where('quote_number', $quote_number)->first();
    }
}
