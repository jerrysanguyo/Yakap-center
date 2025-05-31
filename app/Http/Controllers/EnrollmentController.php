<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityRequest;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\FamilyCompositionRequest;
use App\Http\Requests\GuardianRequest;
use App\Http\Requests\MedicalRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Barangay;
use App\Models\BloodType;
use App\Models\ChildAllergy;
use App\Models\ChildDisability;
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
use App\Models\ParentType;
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

    public function storeChildInfo(ChildInfoRequest $request)
    {
        $childInfo = $this->childFormService->childInfo($request->validated());

        activity()
            ->performedOn($childInfo)
            ->causedBy(Auth::user())
            ->log('Child information submitted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Child information submitted successfully!')
            ->with('currentPage', 2);
    }

    public function storeGuardianInfo(GuardianRequest $request)
    {
        $guardianInfo = $this->childFormService->guardianInfo($request->validated());

        activity()
            ->performedOn($guardianInfo)
            ->causedBy(Auth::user())
            ->log('Guardian information submitted by ' . Auth::user()->first() . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Guardian information submitted successfully!')
            ->with('currentPage', 3);
    }

    public function storeDisabilityInfo(DisabilityRequest $request)
    {
        $disabilityInfo = $this->childFormService->disabilityInfo($request->validated());

        activity()
            ->performedOn($disabilityInfo)
            ->causedBy(Auth::user())
            ->log('Disability information submitted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Disability information submitted successfully!')
            ->with('currentPage', 4);
    }

    public function storeEducationInfo(EducationRequest $request)
    {
        $educationInfo = $this->childFormService->educationInfo($request->validated());

        activity()
            ->performedOn($educationInfo)
            ->causedBy(Auth::user())
            ->log('Education information submitted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Education information submitted successfully!')
            ->with('currentPage', 5);
    }

    public function storeServiceInfo(ServiceRequest $request)
    {
        $serviceInfo = $this->childFormService->serviceInfo($request->validated());

        foreach ($serviceInfo as $service) {
            activity()
                ->performedOn($service)
                ->causedBy(Auth::user())
                ->log("Service “{$service->service->name}” saved for child {$service->child_id}");
        }

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Service information submitted successfully!')
            ->with('currentPage', 6);
    }

    public function storeMedicalInfo(MedicalRequest $request)
    {
        $medicalInfo = $this->childFormService->medicalInfo($request->validated());

        activity()
            ->performedOn($medicalInfo)
            ->causedBy(Auth::user())
            ->log('Medical information submitted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Medical information submitted successfully!')
            ->with('currentPage', 7);
    }

    public function storeFamilyComposition(FamilyCompositionRequest $request)
    {
        $family = $this->childFormService->familyComposition($request->validated());

        foreach ($family as $member) {
            activity()
                ->performedOn($member)
                ->causedBy(Auth::user())
                ->log("Family member “{$member->name}” saved for child {$member->child_id}");
        }

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.enrollment.index')
            ->with('success', 'Family composition submitted successfully!')
            ->with('currentPage', 8);
    }
}