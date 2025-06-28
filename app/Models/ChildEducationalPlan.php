<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEducationalPlan extends Model
{
    use HasFactory;
    protected $table = 'child_educational_plans';
    protected $fillable = [
        'child_id',
        'objective_id',
        'rating_id',
    ];

    public static function getChildEducationalPlan($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }
}
