<?php

namespace App\Domains\Inventory\Receiving\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'location_id',
        'user_id',
        'stock',
        'quantity',
        'description',
    ];

    /**
     * Relasi ke Part
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Relasi ke Location
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
