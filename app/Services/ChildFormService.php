<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ChildInfo;
use App\Models\ChildDisability;
use App\Models\ChildEducation;
use App\Models\ChildService;
use App\Models\ChildMedicalHistory;
use App\Models\ChildMedicine;
use App\Models\ChildAllergy;
use App\Models\ChildEmergency;
use App\Models\ChildFamily;
use App\Models\ParentsInfo;
use App\Models\Consent;
use App\Models\Files;

class ChildFormService
{
    public function idNumber(): string
    {
        $year = now()->year;
        $lastId = DB::table('child_infos')->max('id');
        $nextId = $lastId ? $lastId + 1 : 1;
        $paddedId = str_pad($nextId, 5, '0', STR_PAD_LEFT);
        return $year . $paddedId;
    }

    public function childId($child): ChildInfo
    {
        return ChildInfo::findOrFail($child);
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
        $childInfo = ChildInfo::updateOrCreate(
        [
            'first_name'    => $data['first_name'],
            'middle_name'   => $data['middle_name'],
            'last_name'     => $data['last_name'],
            'birth_date'    => $data['birth_date'],
        ],
        [
            'parent_id'     => Auth::user()->id(),
            'gender_id'     => $data['gender'],
            'house_number'  => $data['house_number'],
            'barangay_id'   => $data['barangay'],
            'district_id'   => $data['district'],
            'city'          => $data['city'],
            'id_number'     => $this->idNumber(),
        ]);

        if($childInfo && isset($data['picture']))
        {
            $pic = $data['picture'];
            $extension = $pic->getClientOriginalExtension();
            $fullName = $data['first_name'] . $data['last_name'];
            $pic_name = $childInfo->id . '-' . $fullName . '-picture.' . $extension; // 1-JerrySanguyo-picture.png
            $destination  = public_path('idPicture');

            $pic->move($destination, $pic_name);

            $childInfo->files()->create([
                'file_name' => $pic_name,
                'file_path' => "idPicture/{$pic_name}",
                'file_type' => 'image',
                'remarks'   => 'picture',
            ]);
        }

        return $childInfo;
    }

    public function parentInfo(array $data, $child): ParentsInfo
    {  
        $name = $data['parent_name'];
        foreach($name as $parent)
        {
            $parents = ParentsInfo::create([
                'child_id' => $this->childId($child),
                'name' => $parent,
                'contact_number' => $data['parent_contact_number'],
                'fb_account' => $data['parent_fb_account'],
                'birth_date' => $data['parent_birth_date'],
                'education_id' => $data['parent_education'],
                'work' => $data['parent_work'],
                'work_place' => $data['parent_work_place'],
                'type_id' => $data['parent_type'],
            ]);
        }

        return $parents;
    }

    public function childDisability(array $data, $child): ChildDisability
    {
        $disability = ChildDisability::create([
            'child_id' => $this->childId($child),
            'disability_id' => $data['child_disability'],
            'pwd_id' => $data['child_pwd_id'],
        ]);

        return $disability;
    }

    public function childEducationa(array $data, $child): ChildEducation
    {
        $education = ChildEducation::create([
            'child_id' => $this->childId($child),
            'education_id' => $data['child_education'],
            'school' => $data['child_school']
        ]);

        return $education;
    }

    public function childService(array $data, $child): ChildService
    {
        $service = ChildService::create([
            'child_id' => $this->childId($child),
            'service_id' => $data['child_service'],
            'answer' => $data['child_answer']
        ]);

        return $service;
    }

    public function childMedicalHistory(array $data, $child): ChildMedicalHistory
    {
        $medical = ChildMedicalHistory::create([
            'child_id' => $this->childId($child),
            'check_up' => $data['child_check_up'],
            'blood_type_id' => $data['child_blood_type'],
        ]);
        
        if($medical)
        {
            $this->childMedicine($data, $child);
            $this->childAllergy($data, $child);
        }

        return $medical;
    }

    public function childMedicine(array $data, $child): ChildMedicine
    {
        $medicines = $data['child_medicine'];
        foreach($medicines as $medicine)
        {
            ChildMedicine::create([
                'child_id' => $this->childId($child),
                'medicine' => $medicine,
            ]);
        }
    }

    public function childAllergy(array $data, $child): ChildAllergy
    {
        $allergies = $data['child_allergy'];
        foreach($allergies as $allergy)
        {
            ChildAllergy::create([
                'child_id' => $this->childId($child),
                'allergy' => $allergy,
            ]);
        }
    }

    public function childEmergency(array $data, $child): ChildEmergency
    {
        $emergency = ChildEmergency::create([
            'child_id' => $this->childId($child),
            'name' => $data['emergency_name'],
            'contact_number' => $data['emergency_contact_number'],
            'relationship_id' => $data['emergency_relation']
        ]);

        return $emergency;
    }

    public function familyComposition(array $data, $child): ChildFamily
    {
        $fams = $data['family_full_name'];
        foreach($fams as $fam)
        {
            $family = ChildFamily::create([
                'child_id' => $this->childId($child),
                'full_name' => $fam,
                'birth_date' => $data['family_birth_date'],
                'gender_id' => $data['family_gender_id'],
                'relationship_id' => $data['family_relationship_id'],
                'civil_id' => $data['family_civil_id'],
                'education_id' => $data['family_education_id'],
                'work' => $data['family_work'],
            ]);

            return $family;
        }
    }

    public function childRequirements(array $data, $child): Files
    {
        if(isset($data['requirements']))
        {
            $requirements = $data['requirements'];
            foreach($requirements as $requirement)
            {
                Files::create([
                    'imageable_id' => $child,
                    'imageable_type' => 'App\Models\ChildInfo',
                ]);
            }
        }
    }
}