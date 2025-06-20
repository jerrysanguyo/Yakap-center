<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDomain extends Model
{
    use HasFactory;
    protected $table = 'learning_domains';
    protected $fillable = [
        'name',
        'remarks',
    ];

    public static function getAllLearningDomains()
    {
        return self::all(); 
    }

    public function goal()
    {
        return $this->hasMany(Goal::class, 'domain_id');
    }

    public function learningCompetency()
    {
        return $this->hasMany(learningCompetency::class);
    }
}
