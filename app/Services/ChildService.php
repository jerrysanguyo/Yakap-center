<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ChildInfo;

class ChildService
{
    public function idNumber(): string
    {
        $year = now()->year;
        $lastId = DB::table('child_infos')->max('id');
        $nextId = $lastId ? $lastId + 1 : 1;
        $paddedId = str_pad($nextId, 5, '0', STR_PAD_LEFT);

        return $year . $paddedId;
    }

    public function childInfo(array $data): ChildInfo
    {
        $childInfo = ChildInfo::create([
            'parent_id' => Auth::user()->id(),
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'gender_id' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'house_number' => $data['house_number'],
            'barangay_id' => $data['barangay'],
            'district_id' => $data['district'],
            'city' => $data['city'],
            'id_number' => $this->idNumber(),
        ]);

        return $childInfo;
    }

    public function parentInfo()
    {

    }

    public function childDisability()
    {

    }

    public function childEducation()
    {

    }

    public function childService()
    {

    }

    public function childMedicalHistory()
    {

    }

    public function childMedicine()
    {

    }

    public function childAllergy()
    {

    }

    public function childEmergency()
    {

    }

    public function familyComposition()
    {

    }
}