<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hmo_provider',
        'hmo_number',
        'patient_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
