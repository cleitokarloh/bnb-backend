<?php

namespace Domain\Transaction\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
    ];
}
