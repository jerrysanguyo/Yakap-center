<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'competency_id',
        'rating_id',
    ];

    public static function getChildProgressReport($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class);
    }

    public function competency()
    {
        return $this->belongsTo(LearningCompetency::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
}
