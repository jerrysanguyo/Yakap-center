<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllRatings()
    {
        return self::all(); 
    }

    public function childEducationalPlans()
    {
        return $this->hasMany(ChildEducationalPlan::class, 'rating_id');
    }
}
