<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $table = 'goals';
    protected $fillable = [
        'domain_id',
        'name',
        'remarks',
    ];

    public static function getAllGoals()
    {
        return self::all();
    }

    public static function getGoal($domain)
    {
        return self::where('domain_id', $domain)->get();
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'goal_id');
    }

    public function domain()
    {
        return $this->belongsTo(LearningDomain::class, 'domain_id');
    }
}
