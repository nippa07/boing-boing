<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quote_id',
        'name',
        'quantity',
        'price',
        'description'
    ];

    public function quote()
    {
        return $this->belongsTo('App\Models\Quote');
    }
}
