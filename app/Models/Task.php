<?php

namespace App\Models;

use App\Enums\PriorityType;
use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'priority',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'priority' => PriorityType::class,
        'status' => StatusType::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
