<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;
    protected $table = 'requirements';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllRequirements()
    {
        return self::all();
    }
}
