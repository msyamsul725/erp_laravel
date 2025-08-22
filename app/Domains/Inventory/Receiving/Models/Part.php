<?php

namespace App\Domains\Inventory\Receiving\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        "part_number",
        "part_name",
        "stock",
        "minimum",
        "is_active"


    ];
    //
}
