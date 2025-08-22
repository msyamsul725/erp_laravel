<?php

namespace App\Domains\UserMangement\Position\Models;

use App\Domains\UserMangement\Departement\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'department_id', 'level', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
