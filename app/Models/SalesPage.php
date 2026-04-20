<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesPage extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'description',
        'features',
        'target_audience',
        'price',
        'unique_selling_points',
        'generated_output'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFeaturesArrayAttribute(): array
    {
        return explode(',', $this->features);
    }
}