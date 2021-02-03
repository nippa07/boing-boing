<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    const MATERIAL = ['GLOSS' => 1, 'MATTE' => 2, 'CLEAR' => 3];
    const STICKER_SHAPE = ['SQUARE' => 1, 'CIRCLE' => 2, 'OVAL' => 3, 'RECTANGLE' => 4, 'CUSTOM' => 5];
    const FINISHING = ['SHEETS' => 1, 'INDIVIDUAL' => 2];

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
        'sticker_size',
        'material',
        'sticker_shape',
        'finishing',
        'quantity',
        'details'
    ];
}
