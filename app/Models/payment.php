<?php

namespace App\Models;

use App\Concerns\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory, HasPrice;

    protected $fillable = [ 
        'status','gateway_reference_id',
    ];
    
    protected $casts =[
        'data' => 'json',
    ];
}
