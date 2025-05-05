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

    public static function getChildService($childId)
    {
        return self::where('child_id', $childId)->get();
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
