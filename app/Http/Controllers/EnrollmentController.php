<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityRequest;
use App\Http\Requests\GuardianRequest;
use App\Models\Barangay;
use App\Models\ChildDisability;
use App\Models\ChildInfo;
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
            $genders = Gender::getAllGenders();
            $districts = District::getAllDistricts();
            $barangays = Barangay::getAllBarangays();
            $educations = Education::getAllEducations();
            $disabilities = Disability::getAllDisabilities();
            $childInfo = ChildInfo::getChildInfo(Auth::user()->id);
            $fatherInfo = Consent::getFatherChild(Auth::user()->id);
            $motherInfo = Consent::getMotherChild(Auth::user()->id);
            $fetchedFather = ParentsInfo::getFatherInfo(Auth::user()->child->first()->id);
            $fetchedMother = ParentsInfo::getMotherInfo(Auth::user()->child->first()->id);
            return view('enrollment.enrollmentForm', compact(
                'genders', 
                'districts',
                'barangays',
                'educations',
                'disabilities',
                'childInfo',
                'fatherInfo',
                'motherInfo',
                'fetchedFather',
                'fetchedMother',
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
}
