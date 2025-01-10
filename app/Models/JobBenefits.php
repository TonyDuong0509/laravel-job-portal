<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobBenefits extends Model
{
    use HasFactory;

    public function benefit(): BelongsTo
    {
        return $this->belongsTo(Benefits::class, 'benefit_id', 'id');
    }
}
