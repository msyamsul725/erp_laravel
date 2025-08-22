<?php


namespace App\Domains\Inventory\Receiving\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Jika nama tabel sesuai konvensi ("transactions"), nggak perlu didefinisikan lagi.
    protected $fillable = [
        'location_id',
        'part_id',
    ];

    /**
     * Relasi ke Location
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Relasi ke Part
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
