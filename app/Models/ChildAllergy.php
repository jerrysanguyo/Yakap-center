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
        'allergy_id',
    ];

    public static function getChildAllergies($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function allergy()
    {
        return $this->belongsTo(Allergy::class, 'allergy_id');
    }
}
