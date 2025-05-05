<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'accomodations';
    protected $fillable = [
        'objective_id',
        'name',
        'remarks',
    ];

    public static function getAllAccomodations($objective)
    {
        return self::where('objective_id', $objective)->get();
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }
}
