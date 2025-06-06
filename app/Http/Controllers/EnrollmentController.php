<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityRequest;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\EmergencyRequest;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests\FamilyCompositionRequest;
use App\Http\Requests\GuardianRequest;
use App\Http\Requests\MedicalRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Barangay;
use App\Models\BloodType;
use App\Models\ChildAllergy;
use App\Models\ChildDisability;
use App\Models\ChildEmergency;
use App\Models\ChildFamily;
use App\Models\ChildInfo;
use App\Models\ChildMedicalHistory;
use App\Models\ChildMedicine;
use App\Models\ChildService;
use App\Models\CivilStatus;
use App\Models\Disability;
use App\Models\District;
use App\Models\Education;
use App\Models\Gender;
use App\Models\ParentsInfo;
use App\Models\Consent;
use App\Http\requests\ConsentRequest;
use App\Http\requests\ChildInfoRequest;
use App\Models\Relation;
use App\Models\Service;
use App\Services\ChildFormService;
use Illuminate\Support\Facades\Auth;


class EnrollmentController extends Controller
{
    protected $childFormService;
    
    public function __construct(ChildFormService $childFormService)
    {
        $this->childFormService = $childFormService;
    }

    public function index()
    {
        $consent = Consent::getConsent(Auth::user()->id);
        if ($consent)
        {
            // Fetching all dropdown data
            $relations = Relation::getAllRelations();
            $genders = Gender::getAllGenders();
            $districts = District::getAllDistricts();
            $barangays = Barangay::getAllBarangays();
            $educations = Education::getAllEducations();
            $disabilities = Disability::getAllDisabilities();
            $educations = Education::getAllEducations();
            $yesServices = Service::getYesServices();
            $noServices = Service::getNoServices();
            $bloodTypes = BloodType::getAllBloodTypes();
            $civilStatuses = CivilStatus::getAllCivilStatuses();
            // Fetching existing data for the child
            $childInfo = ChildInfo::getChildInfo(Auth::user()->id);
            $fatherInfo = Consent::getFatherChild(Auth::user()->id);
            $motherInfo = Consent::getMotherChild(Auth::user()->id);
            $fetchedFather = ParentsInfo::getFatherInfo(Auth::user()->child->first()->id);
            $fetchedMother = ParentsInfo::getMotherInfo(Auth::user()->child->first()->id);
            $existingYesIds  = ChildService::getYesServiceIds(Auth::user()->child->first()->id);
            $existingNoIds   = ChildService::getNoServiceIds(Auth::user()->child->first()->id);
            $existingOtherYes = ChildService::getOtherYes(Auth::user()->child->first()->id);
            $existingOtherNo  = ChildService::getOtherNo(Auth::user()->child->first()->id);
            $existingMedications = ChildMedicine::getChildMedicines(Auth::user()->child->first()->id);
            $existingAllergies = ChildAllergy::getChildAllergies(Auth::user()->child->first()->id);
            $existingChildMedical = ChildMedicalHistory::getChildMedicalHistory(Auth::user()->child->first()->id);
            $existingFamily = ChildFamily::getChildFamily(Auth::user()->child->first()->id);
            $existingEmergency = ChildEmergency::getChildEmergency(Auth::user()->child->first()->id);

            return view('enrollment.enrollmentForm', compact(
                'relations', 
                'genders', 
                'districts',
                'barangays',
                'educations',
                'disabilities',
                'educations',
                'yesServices',
                'noServices',
                'bloodTypes',
                'civilStatuses',
                'childInfo',
                'fatherInfo',
                'motherInfo',
                'fetchedFather',
                'fetchedMother',
                'existingYesIds',
                'existingNoIds',
                'existingOtherYes',
                'existingOtherNo',
                'existingMedications',
                'existingAllergies',
                'existingChildMedical',
                'existingFamily',
                'existingEmergency',
            ));
        } else {
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.consent.index')
                ->with('failed', 'Please fill out the consent form first.');
        }
    }
    public function consentForm()
    {
        $parentType = Relation::getAllRelations();
        return view('enrollment.consentForm', compact(
            'parentType'
        ));
    }

    public function consentStore(ConsentRequest $request)
    {
        $consent = $this->childFormService->consent($request->validated());

        activity()
            ->performedOn($consent)
            ->causedBy(Auth::user())
            ->log('Consent form submitted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Consent form submitted successfully!');
    }

    public function enrollmentStore(EnrollmentRequest $request)
    {
        $enrollment= $this->childFormService->storeAllChildData($request->validated());

        activity()
            ->performedOn($enrollment)
            ->causedBy(Auth::user())
            ->log('User' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' submitted an enrollment form');

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Consent form submitted successfully!');
    }

}