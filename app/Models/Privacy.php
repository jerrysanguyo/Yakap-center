<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    use HasFactory;
    protected $table = 'privacies';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getPrivacy()
    {
        return self::first();
    }

    public static function getAllPrivacy()
    {
        return self::all();
    }
}
