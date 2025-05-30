<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMedicine extends Model
{
    use HasFactory;
    protected $table = 'child_medicines';
    protected $fillable = [
        'child_id',
        'medicine',
    ];

    public static function getChildMedicines($childId)
    {
        return self::where('child_id', $childId)
            ->pluck('medicine')
            ->toArray();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }
}
