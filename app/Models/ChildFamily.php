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
        return self::where('child_id', $childId)
            ->get()
            ->map(fn($f) => [
                'name' => $f->full_name,
                'birthday' => $f->birth_date,
                'sex' => $f->gender_id,
                'relation' => $f->relationship_id,
                'civil_status' => $f->civil_id,
                'education' => $f->education_id,
                'work' => $f->work,
            ])
            ->toArray();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function relationship()
    {
        return $this->belongsTo(Relation::class, 'relationship_id');
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }
}
