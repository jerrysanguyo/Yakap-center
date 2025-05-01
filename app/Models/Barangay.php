<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;
    protected $table = 'barangays';
    protected $fillable = [
        'name',
        'remarks',
        'district_id',
    ];
    
    public static function getAllBarangays()
    {
        return self::all();
    }

    public static function getBarangayPerDistrict($districtId)
    {
        return self::where('district_id', $districtId)->get();
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
