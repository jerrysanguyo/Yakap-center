<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;
    protected $table = 'consents';
    protected $fillable = [
        'user_id',
        'answer',
        'relation_id',
        'child_id'
    ];

    public static function getConsent($id)
    {
        return self::where('user_id', $id)->first();
    }

    public static function getConsentPerChild($id)
    {
        return self::where('child_id', $id)->get();
    }

    public static function getFatherChild($id)
    {
        return self::where('user_id', $id)
            ->where('relation_id', 1)
            ->first();
    }

    public static function getMotherChild($id)
    {
        return self::where('user_id', $id)
            ->where('relation_id', 2)
            ->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class, 'relation_id');
    }
}
