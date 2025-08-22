<?php

namespace App\Domains\Inventory\Receiving\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadLocation extends Model
{
    use HasFactory;

    protected $table = 'head_location';

    protected $fillable = [
        'location_name',
        'max_lantai',
        'max_rak',
    ];
}
