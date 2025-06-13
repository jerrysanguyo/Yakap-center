<?php

namespace App\Http\Controllers;

use App\Models\ChildFamily;
use App\Models\ParentsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function index()
    {
        $childId = Auth::user()->child->first()->id;
        $child = Auth::user()->child->first();
        $motherInfo = ParentsInfo::getMotherInfo($childId);
        $fatherInfo = ParentsInfo::getFatherInfo($childId);
        $family = ChildFamily::getFamilyPerChild($childId);
        return view('children.profile', compact(
            'motherInfo',
            'fatherInfo',
            'family',
            'childId',
            'child'
        ));
    }
}
