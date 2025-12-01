<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    protected $table = 'weight_target';
    
    protected $fillable = [
        'target_weight',
        'user_id',
    ];
}
