<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildAllergy extends Model
{
    use HasFactory;
    protected $table = 'child_allergies';
    protected $fillable = [
        'child_id',
        'allergy',
    ];

    public static function getChildAllergies($childId)
    {
        return self::where('child_id', $childId)
            ->pluck('allergy')
            ->toArray();
    }

    public static function getChildAllerg($childId)
    {
        return self::where('child_id', $childId)
            ->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }
}