<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributors extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_name', 'amount'];

    public function collections(): BelongsTo
    {
        return $this->belongsTo(Collections::class);
    }
}
