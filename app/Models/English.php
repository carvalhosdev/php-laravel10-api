<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class English extends Model
{
    use HasFactory;

    protected $fillable = [
        'phrase',
        'translate',
        'audio',
        'explanation',
        'image',
        'user_id',
        'card_id'
    ];

    public function card(): BelongsTo{
        return $this->belongsTo(Card::class, 'card_id');
    }
}
