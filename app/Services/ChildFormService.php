<?php

namespace App\Services;

use App\Models\ApplicationStatus;
use App\Models\Service;
use File;
use Illuminate\Http\UploadedFile;
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

            ApplicationStatus::updateOrCreate(
                [
                    'child_id' => $child->id,
                ],
                [
                    'status' => 'answered consent form',
                ]
            );

            return $child;
        }

        return null;
    }

    public function storeAllChildData(array $data)
    {
        return DB::transaction(function () use ($data) {
            $userId = Auth::user()->id;

            $childInfo = ChildInfo::updateOrCreate(
                [
                    'parents_id'  => $userId,
                    'first_name'  => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name'   => $data['last_name'],
                    'birth_date'  => $data['birth_date'],
                ],
                [
                    'gender_id'    => $data['gender_id'],
                    'house_number' => $data['house_number'],
                    'barangay_id'  => $data['barangay_id'],
                    'district_id'  => $data['district_id'],
                    'city'         => $data['city'],
                    'id_number'    => $this->idNumber(),
                ]
            );
            
            if ($childInfo && isset($data['picture'])) {
                $pic       = $data['picture'];
                $extension = $pic->getClientOriginalExtension();
                $fullName  = $data['first_name'] . $data['last_name'];
                $picName   = $childInfo->id . '-' . $fullName . '-picture.' . $extension;
                $destination = public_path('idPicture');

                $pic->move($destination, $picName);

                $childInfo->files()->create([
                    'file_name' => $picName,
                    'file_path' => "idPicture/{$picName}",
                    'file_type' => 'image',
                    'remarks'   => 'picture',
                ]);
            }

            $childId = $childInfo->id;
            
            ParentsInfo::updateOrCreate(
                [
                    'child_id' => $childId,
                    'type_id'  => 2, 
                ],
                [
                    'name'           => $data['mother_name'],
                    'email'          => $data['mother_email'],
                    'birth_date'     => $data['mother_birthdate'],
                    'birth_place'    => $data['mother_birthplace'],
                    'contact_number' => $data['mother_contact_number'],
                    'fb_account'     => $data['mother_facebook'],
                    'education_id'   => $data['mother_educational_attainment'],
                    'work_place'     => $data['mother_workplace'],
                ]
            );

            ParentsInfo::updateOrCreate(
                [
                    'child_id' => $childId,
                    'type_id'  => 1,
                ],
                [
                    'name'           => $data['father_name'],
                    'email'          => $data['father_email'],
                    'birth_date'     => $data['father_birthdate'],
                    'birth_place'    => $data['father_birthplace'],
                    'contact_number' => $data['father_contact_number'],
                    'fb_account'     => $data['father_facebook'],
                    'education_id'   => $data['father_educational_attainment'],
                    'work_place'     => $data['father_workplace'],
                ]
            );
            
            ChildDisability::updateOrCreate(
                ['child_id' => $childId],
                [
                    'disability_id' => $data['disability'],
                    'pwd_id'        => $data['pwd_no'],
                ]
            );
            
            ChildEducation::updateOrCreate(
                ['child_id' => $childId],
                [
                    'education_id' => $data['education'],
                    'school'       => $data['school'],
                ]
            );
            
            ChildService::where('child_id', $childId)->delete();

            $answer   = $data['receivedService'];
            $field    = $answer === 'Oo' ? 'yesService' : 'noService';
            $items    = $data[$field] ?? [];
            $otherYes = $data['otherYes'] ?? null;
            $otherNo  = $data['otherNo']  ?? null;
            $other    = $answer === 'Oo' ? $otherYes : $otherNo;

            $othersServiceIds = Service::whereRaw('LOWER(name)=?', ['others'])
                ->orWhereRaw('LOWER(name)=?', ['other'])
                ->pluck('id')
                ->toArray();

            foreach ($items as $serviceId) {
                $isOthers = in_array((int)$serviceId, $othersServiceIds);

                ChildService::updateOrCreate(
                    [
                        'child_id'   => $childId,
                        'service_id' => $serviceId,
                    ],
                    [
                        'answer' => $answer,
                        'others' => $isOthers ? $other : null,
                    ]
                );
            }
            
            ChildMedicalHistory::updateOrCreate(
                ['child_id' => $childId],
                [
                    'check_up'      => $data['checkUp'],
                    'blood_type_id' => $data['bloodType'],
                ]
            );

            ChildMedicine::where('child_id', $childId)->delete();
            foreach ($data['medication'] as $med) {
                $med = trim($med);
                if ($med === '') continue;
                ChildMedicine::updateOrCreate(
                    ['child_id' => $childId, 'medicine' => $med],
                    ['medicine' => $med]
                );
            }

            ChildAllergy::where('child_id', $childId)->delete();
            foreach ($data['allergy'] as $alg) {
                $alg = trim($alg);
                if ($alg === '') continue;
                ChildAllergy::updateOrCreate(
                    ['child_id' => $childId, 'allergy' => $alg],
                    ['allergy' => $alg]
                );
            }
            
            ChildFamily::where('child_id', $childId)->delete();
            foreach ($data['family'] as $row) {
                if (
                    empty($row['name']) &&
                    empty($row['birthday']) &&
                    empty($row['age']) &&
                    empty($row['relation']) &&
                    empty($row['education']) &&
                    empty($row['work'])
                ) {
                    continue;
                }
                ChildFamily::updateOrCreate(
                    [
                        'child_id'  => $childId,
                        'full_name' => $row['name'] ?? null,
                    ],
                    [
                        'birth_date'      => $row['birthday']     ?? null,
                        'gender_id'       => $row['sex']          ?? null,
                        'relationship_id' => $row['relation']     ?? null,
                        'civil_id'        => $row['civil_status'] ?? null,
                        'education_id'    => $row['education']    ?? null,
                        'work'            => $row['work']         ?? null,
                    ]
                );
            }
            
            ChildEmergency::updateOrCreate(
                ['child_id' => $childId],
                [
                    'name'             => $data['emergency_name'],
                    'contact_number'   => $data['emergency_contact'],
                    'relationship_id'  => $data['relation'],
                ]
            );

            ApplicationStatus::updateOrCreate(
                [
                    'child_id' => $childId,
                ],
                [
                    'status' => 'submitted enrollment form',
                ]
            );
            
            return $childInfo; 
        });
    }

    public function storeRequirementChild(array $filesData): void
    {
        $childId = Auth::user()->child()->first()->id;
        $folderName = sprintf(
            '%d-%s%s-%s',
            $childId,
            str_replace(' ', '', Auth::user()->child()->first()->first_name),
            str_replace(' ', '', Auth::user()->child()->first()->last_name),
            Auth::user()->child()->first()->birth_date
        );
        
        $destinationDir = public_path("requirements/{$folderName}");
        if (! File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        foreach ($filesData as $requirementId => $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }
            
            $existing = Files::where([
                ['imageable_type', ChildInfo::class],
                ['imageable_id',   $childId],
                ['remarks',        $requirementId],
            ])->first();
            
            if ($existing && File::exists(public_path($existing->file_path))) {
                File::delete(public_path($existing->file_path));
            }
            
            $filename = $requirementId . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationDir, $filename);
            
            Files::updateOrCreate(
                [
                    'imageable_type' => ChildInfo::class,
                    'imageable_id'   => $childId,
                    'remarks'        => $requirementId,
                ],
                [
                    'file_path' => "requirements/{$folderName}/{$filename}",
                    'file_name' => $filename,
                    'file_type' => $file->getClientMimeType(),
                ]
            );

            ApplicationStatus::updateOrCreate(
                [
                    'child_id' => $childId,
                ],
                [
                    'status' => 'submitted requirements',
                ]
            );
        }
    }
}