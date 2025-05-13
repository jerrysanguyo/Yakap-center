<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningCompetency extends Model
{
    use HasFactory;
    protected $table = 'learning_competencies';
    protected $fillable = [
        'domain_id',
        'name',
        'remarks',
    ];

    public static function getLearningCompetencies($domain)
    {
        return self::where('domain_id', $domain)->get();
    }

    public static function getAllLearningCompetencies()
    {
        return self::all();
    }

    public function domain()
    {
        return $this->belongsTo(learningDomain::class, 'domain_id');
    }
}
