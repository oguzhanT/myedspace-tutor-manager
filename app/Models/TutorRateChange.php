<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorRateChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'old_hourly_rate',
        'new_hourly_rate',
    ];

    public function tutor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }
}
