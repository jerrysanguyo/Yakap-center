<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    use HasFactory;
    protected $table = 'application_statuses';
    protected $fillable = [
        'child_id',
        'status'
    ];

    public static function getChildStatus($child)
    {
        return self::where('child_id', $child)->first();
    }

    public function child()
    {
        return $this->belongsTo(ChildInfo::class, 'child_id');
    }
}
