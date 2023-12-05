<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'description',
        'status',
        'proposed_price',
        'final_price',
    ];

    // Methods to define relationships between models

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
