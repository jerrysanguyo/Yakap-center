<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\ChildInfo;
use App\Models\District;
use App\Models\Gender;
use App\Models\ParentType;
use App\Models\Consent;
use App\Http\requests\ConsentRequest;
use App\Http\requests\ChildInfoRequest;
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
            $childInfo = ChildInfo::getChildInfo(Auth::user()->id);
            return view('enrollment.enrollmentForm', compact(
                'genders', 
                'districts',
                'barangays',
                'childInfo',
            ));
        } else {
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.consent.index')
                ->with('failed', 'Please fill out the consent form first.');
        }
    }

    public function consentForm()
    {
        $parentType = ParentType::getAllParentTypes();
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
            ->with('success', 'Cosent form submitted successfully!');
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
            ->with('success', 'Child information submitted successfully!');
    }
}
