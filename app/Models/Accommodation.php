<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'accommodations';
    protected $fillable = [
        'objective_id',
        'name',
        'remarks',
    ];

    public static function getAccomodations($objective)
    {
        return self::where('objective_id', $objective)->get();
    }

    public static function getAllAccommodations()
    {
        return self::all();
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }
}
