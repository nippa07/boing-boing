<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    use HasFactory;

    const TYPE = ['BUMPER_STICKERS' => 1, 'VINYL_STICKERS' => 2, 'CLEAR_VINYL_STICKERS' => 3, 'CLEAR_VINYL_STICKERS_WITH_WHITE_INK' => 4, 'HIGH_TRACK_STICKERS' => 5, 'BLOCKOUT_VINYL_STICKERS' => 6, 'GOLD_SILVER_VINYL_STICKERS' => 7];
    const TURNAROUND_TIME = ['1_2_DAYS' => 1, '2_3_DAYS' => 2, '3_5_DAYS' => 3, '5_7_DAYS' => 4];

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
        'description',
        'type',
        't_time'
    ];

    public function quote()
    {
        return $this->belongsTo('App\Models\Quote');
    }
}
