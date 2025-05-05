<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildDisability extends Model
{
    use HasFactory;
    protected $table = 'child_disabilities';
    protected $fillable = [
        'child_id',
        'disability_id',
        'pwd_id',
    ];

    public static function getChildDisabilities($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }
}
