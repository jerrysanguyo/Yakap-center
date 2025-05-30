<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildService extends Model
{
    use HasFactory;
    protected $table = 'child_services';
    protected $fillable = [
        'child_id',
        'service_id',
        'answer',
        'others',
    ];

    public static function getChildService(int $childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public static function getYesServiceIds(int $childId): array
    {
        return self::where('child_id', $childId)
            ->where('answer', 'Oo')
            ->pluck('service_id')
            ->toArray();
    }
    
    public static function getNoServiceIds(int $childId): array
    {
        return self::where('child_id', $childId)
            ->where('answer', 'Hindi')
            ->pluck('service_id')
            ->toArray();
    }
    
    public static function getOtherYes(int $childId): ?string
    {
        return self::where('child_id', $childId)
            ->where('answer', 'Oo')
            ->whereNotNull('others')
            ->value('others');
    }
    
    public static function getOtherNo(int $childId): ?string
    {
        return self::where('child_id', $childId)
            ->where('answer', 'Hindi')
            ->whereNotNull('others')
            ->value('others');
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
