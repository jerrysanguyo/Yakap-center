<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentType extends Model
{
    use HasFactory;
    protected $table = 'parent_types';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllParentTypes()
    {
        return self::all();
    }
}
