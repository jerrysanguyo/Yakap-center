<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRemarks extends Model
{
    use HasFactory;
    protected $table = 'general_remarks';
    protected $fillable = [
        'child_id',
        'progress_id',
        'remarks',
    ];

    public static function getGeneralRemarksByChild($childId)
    {
        return self::where('child_id', $childId)->get();
    }

    public static function getGeneralRemarksByProgress($progressId)
    {
        return self::where('progress_id', $progressId)->get();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }

    public function progress()
    {
        return $this->belongsTo(ProgressReport::class, 'progress_id');
    }
}
