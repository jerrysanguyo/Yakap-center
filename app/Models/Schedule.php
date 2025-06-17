<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'parent_id',
        'date',
        'time',
        'status',
        'remarks'
    ];

    public static function getSchedulePerDay()
    {
        return self::where('date', now())->get();
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
