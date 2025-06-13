<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\ChildInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $district1 = Barangay::getBarangayPerDistrict(1);
        $district2 = Barangay::getBarangayPerDistrict(2);
        $children = ChildInfo::getAllChildNames();
        return view('dashboard.index', compact(
            'district1',
            'district2',
            'children'
        ));
    }
}
