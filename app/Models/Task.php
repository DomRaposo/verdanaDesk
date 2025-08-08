<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusTaskEnum;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => StatusTaskEnum::class,
    ];

    /**
     * Get the status options for the task
     */
    public static function getStatusOptions()
    {
        return StatusTaskEnum::values();
    }
}
