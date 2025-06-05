<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEmergency extends Model
{
    use HasFactory;
    protected $table = 'child_emergencies';
    protected $fillable = [
        'child_id',
        'name',
        'contact_number',
        'relationship_id',
    ];
    
    public static function getChildEmergency(int $childId): ?self
    {
        return self::where('child_id', $childId)->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function relationship()
    {
        return $this->belongsTo(Relation::class, 'relationship_id');
    }
}
