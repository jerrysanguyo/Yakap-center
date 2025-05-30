<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
use Illuminate\Support\Collection; 

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

    public function childId($child): Int
    {
        ChildInfo::findOrFail($child);

        return $child;
    }

    public function consent(array $data)
    {
        $child = ChildInfo::firstOrCreate(
            [
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'birth_date' => $data['birth_date'],
            ],
            [
                'parents_id'     => Auth::user()->id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'birth_date' => $data['birth_date'],
            ]
        );

        if($child)
        {
            Consent::create([
                'user_id' => Auth::user()->id,
                'answer' => $data['consent_answer'],
                'relation_id' => $data['relation'],
                'child_id' => $child->id,
            ]);

            return $child;
        }

        return null;
    }
    
    public function childInfo(array $data): ChildInfo
    {
        $childInfo = ChildInfo::UpdateOrCreate(
        [
            'parents_id'     => Auth::user()->id,
            'first_name'    => $data['first_name'],
            'middle_name'   => $data['middle_name'],
            'last_name'     => $data['last_name'],
            'birth_date'    => $data['birth_date'],
        ],
        [
            'gender_id'     => $data['gender_id'],
            'house_number'  => $data['house_number'],
            'barangay_id'   => $data['barangay_id'],
            'district_id'   => $data['district_id'],
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

    public function guardianInfo(array $data): ParentsInfo
    {  
        $mother = ParentsInfo::updateOrCreate(
            [
                'child_id' => $this->childId(Auth::user()->child->first()->id),
                'type_id'  => 2,
            ],
            [
                'name'            => $data['mother_name'],
                'email'            => $data['mother_email'],
                'birth_date'      => $data['mother_birthdate'],
                'birth_place'     => $data['mother_birthplace'],
                'contact_number'  => $data['mother_contact_number'],
                'fb_account'      => $data['mother_facebook'],
                'education_id'    => $data['mother_educational_attainment'],
                'work_place'      => $data['mother_workplace'],
            ]
        );
        
        $father = ParentsInfo::updateOrCreate(
            [
                'child_id' => $this->childId(Auth::user()->child->first()->id),
                'type_id'  => 1,
            ],
            [
                'name'            => $data['father_name'],
                'email'            => $data['father_email'],
                'birth_date'      => $data['father_birthdate'],
                'birth_place'     => $data['father_birthplace'],
                'contact_number'  => $data['father_contact_number'],
                'fb_account'      => $data['father_facebook'],
                'education_id'    => $data['father_educational_attainment'],
                'work_place'      => $data['father_workplace'],
            ]
        );

        return $father;
    }

    public function disabilityInfo(array $data): ChildDisability
    {
        $disability = ChildDisability::updateOrCreate(
        ['child_id' => $this->childId(Auth::user()->child->first()->id)],
        [
            'disability_id' => $data['disability'],
            'pwd_id' => $data['pwd_no'],
        ]);

        return $disability;
    }

    public function educationInfo(array $data): ChildEducation
    {
        $education = ChildEducation::updateOrCreate(
        ['child_id' => $this->childId(Auth::user()->child->first()->id)],
        [
            
            'education_id' => $data['education'],
            'school' => $data['school']
        ]);

        return $education;
    }

    public function serviceInfo(array $data): Collection
    {
        $childId = Auth::user()->child->first()->id;
        $answer  = $data['receivedService'];
        $field   = $answer === 'Oo' ? 'yesService' : 'noService';
        $items   = $data[$field] ?? [];
        $otherYes = $data['otherYes'] ?? null;
        $otherNo  = $data['otherNo']  ?? null;
        $other    = $answer === 'Oo' ? $otherYes : $otherNo;

        ChildService::where('child_id', $childId)->delete();

        $othersService = Service::whereRaw('LOWER(name)=?', ['others'])
            ->orWhereRaw('LOWER(name)=?', ['other'])
            ->pluck('id')
            ->toArray();
            
        $created = collect();

        foreach ($items as $serviceId) {
            $isOthers = in_array((int)$serviceId, $othersService);

            $record = ChildService::updateOrCreate(
                ['child_id'   => $childId, 'service_id' => $serviceId],
                [
                'answer' => $answer,
                'others' => $isOthers ? $other : null,
                ]
            );

            $created->push($record);
        }

        return $created;
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