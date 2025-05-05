<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllServices()
    {
        return self::all();
    }

    public static function getYesServices()
    {
        return self::where('remarks', 'Oo')->get();
    }

    public static function getNoServices()
    {
        return self::where('remarks', 'Hindi')->get();
    }
}
