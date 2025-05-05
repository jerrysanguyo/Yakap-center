<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentsInfo extends Model
{
    use HasFactory;
    protected $table = 'parents_infos';
    protected $fillable = [
        'child_id',
        'name',
        'contact_number',
        'fb_account',
        'birth_date',
        'birth_place',
        'education_id',
        'work',
        'work_place',
        'type_id'
    ];

    public static function getParentsInfo($child)
    {
        return self::where('child_id', $child->id)->get();
    }

    public static function getFatherInfo($child)
    {
        return self::where('child_id', $child->id)
            ->where('type_id', 1) // collumn name father
            ->first();
    }

    public static function getMotherInfo($child)
    {
        return self::where('child_id', $child->id)
            ->where('type_id', 2) // collumn name mother
            ->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }

    public function type()
    {
        return $this->belongsTo(ParentType::class, 'type_id');
    }
}
