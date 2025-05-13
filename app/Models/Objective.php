<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    protected $table = 'objectives';
    protected $fillable = [
        'goal_id',
        'name',
        'remarks',
    ];

    public static function getObjectives($goal)
    {
        return self::where('goal_id', $goal)->get();
    }

    public static function getAllObjectives()
    {
        return self::all();
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
