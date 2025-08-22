<?php

namespace App\Domains\UserMangement\Departement\Models;

use App\Domains\UserMangement\Position\Models\Position as ModelsPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model

{
    use HasFactory;
    protected $fillable = ['name', 'code', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jobs()
    {
        return $this->hasMany(ModelsPosition::class);
    }   //
}
