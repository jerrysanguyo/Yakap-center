<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMedicalHistory extends Model
{
    use HasFactory;
    protected $table = 'child_medical_histories';
    protected $fillable = [
        'child_id',
        'check_up',
        'blood_type_id',
    ];

    public static function getChildMedicalHistory($childId)
    {
        return self::where('child_id', $childId)->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
}
