<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    protected CmsService $cmsService;

    public function __construct()
    {
        $this->cmsService = new CmsService(District::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Districts';
        $resource = 'districts';
        $columns = ['name', 'remarks', 'actions'];
        $data = District::getAllDistricts();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => 'districts']);
        if($district = $this->cmsService->cmsStore($request->validated()))
        {
            activity()
                ->performedOn($district)
                ->causedBy(Auth::user())
                ->log('District named ' . $district->name . ' created successfullly by: '. Auth::user()->id);
            return redirect()
                ->route(Auth::user()->getUserRoles->first() . '.district.index')
                ->with('success', 'District named ' . $district->name . 'created successfullly!');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('District creation failed by: '. Auth::user()->id);
            
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.district.index')
                ->with('failed', 'District creation failed.');
        }
    }
    
    public function update(CmsRequest $request, District $district)
    {
        $request->merge(['cms_table' => 'districts', 'id' => $district->id]);

        if($district = $this->cmsService->cmsUpdate($request->validated()))
        {
            activity()
                ->performedOn($district)
                ->causedBy(Auth::user())
                ->log('District name '. $district->name . ' updated successfully by: ' . Auth::user()->id);
            
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.district.index')
                ->with('success', 'District name ' . $district->name . ' updated successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('District name ' . $district->name . ' was faied to update');
            
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.district.index')
                ->with('failed', 'District name ' . $district->name . ' was failed to update by: ' . Auth::user()->id);
        }
    }
    
    public function destroy(District $district)
    {
        $districtName = $district->name;
        if($district = $this->cmsService->cmsDestroy($district->id))
        {
            activity()
                ->performedOn($district)
                ->causedBy(Auth::user())
                ->log('District name ' . $districtName . ' deleted successfully by: ' . Auth::user()->id);
            
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.district.index')
                ->with('success', 'District name ' . $districtName . ' deleted successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('District name ' . $districtName . ' was failed to delete by: ' . Auth::user()->id);
            
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.district.index')
                ->with('failed', 'District name ' . $districtName . ' was failed to delete');
        }
    }
}
