<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'objective_id',
        'rate_id',
    ];

    public static function getChildEducationPlan($childId, $objective)
    {
        return self::where('child_id', $childId)
            ->where('objective_id', $objective)
            ->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class);
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rating::class);
    }
}
