<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'programs';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllPrograms()
    {
        return self::all();
    }
}
