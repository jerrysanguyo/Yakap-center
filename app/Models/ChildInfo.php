<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
    use HasFactory;
    protected $table = 'child_infos';
    protected $fillable = [
        'id_number',
        'parents_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender_id',
        'birth_date',
        'house_number',
        'barangay_id',
        'district_id',
        'city',
    ];

    public static function getChildInfo($parents_id)
    {
        return self::where('parents_id', $parents_id)->first();
    }

    public function parents()
    {
        return $this->belongsTo(User::class, 'parents_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function files()
    {
        return $this->morphMany(Files::class, 'imageable');
    }

    public function disability()
    {
        return $this->hasOne(ChildDisability::class, 'child_id');
    }

    public function education()
    {
        return $this->hasOne(ChildEducation::class, 'child_id');
    }

    public function family()
    {
        return $this->hasMany(ChildFamily::class, 'child_id');
    }
}
