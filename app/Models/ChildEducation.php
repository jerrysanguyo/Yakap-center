<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEducation extends Model
{
    use HasFactory;
    protected $table = 'child_education';
    protected $fillable = [
        'child_id',
        'education_id',
        'school',
    ];

    public static function getChildEducation($childId)
    {
        return self::where('child_id', $childId)->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }
}
