<?php

namespace App\Domains\Inventory\Receiving\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_name',
        'quantity',
        'head_location_id',
        'user_id'
    ];
    //

    public function headLocation()
    {
        return $this->belongsTo(HeadLocation::class, 'head_location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
