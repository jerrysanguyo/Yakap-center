<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildFamily extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'full_name',
        'birth_date',
        'gender_id',
        'relationship_id',
        'civil_id',
        'education_id',
        'work',
    ];

    public static function getChildFamily($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relation::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
