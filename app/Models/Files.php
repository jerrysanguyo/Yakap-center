<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'file_path',
        'file_name',
        'file_type',
        'remarks',
    ];

    public static function childPicture($childId)
    {
        return self::where('imageable_id', $childId)
                    ->where('remarks', '8')
                    ->first();
    }

    public static function childRequirements($childId, $requirementId)
    {
        return self::where('imageable_id', $childId)
                    ->where('remarks', $requirementId)
                    ->first();
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
