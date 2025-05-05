<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    use HasFactory;
    protected $table = 'disabilities';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllDisabilities()
    {
        return self::all();
    }
}
