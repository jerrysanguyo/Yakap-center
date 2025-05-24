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
        'relation_id'
    ];

    public static function getConsent($id)
    {
        return self::where('user_id', $id)->first();
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
