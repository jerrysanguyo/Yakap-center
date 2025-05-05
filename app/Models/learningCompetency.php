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

    public static function getAllLearningCompetencies($domain)
    {
        return self::where('domain_id', $domain)->get();
    }

    public function domain()
    {
        return $this->belongsTo(learningDomain::class, 'domain_id');
    }
}
