<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ChildInfo;
use App\Models\Consent;

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

    public function consent(array $data)
    {
        $consent = Consent::create([
            'user_id' => Auth::user()->id,
            'answer' => $data['consent_answer'],
            'relation' => $data['relation'],
        ]);

        if($consent)
        {
            ChildInfo::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'birth_date' => $data['birth_date'],
            ]);

            return $consent;
        }

        return null;
    }

    public function childInfo(array $data): ChildInfo
    {
        $childInfo = ChildInfo::updateOrCreate([
            'parent_id' => Auth::user()->id(),
            'gender_id' => $data['gender'],
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