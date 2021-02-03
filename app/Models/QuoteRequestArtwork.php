<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequestArtwork extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'quote_request_id'
    ];

    public function quote_request()
    {
        return $this->belongsTo('App\Models\QuoteRequest');
    }
}
