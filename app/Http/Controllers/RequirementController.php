<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use Illuminate\Support\Facades\Auth;

class RequirementController extends Controller
{
    protected CmsService $cmsService;

    public function __construct()
    {
        $this->cmsService = new CmsService(Requirement::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Requirements';
        $resource = 'requirements';
        $columns = ['name', 'remarks', 'Action'];
        $data = Requirement::getAllRequirements();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable'
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => 'requirements']);
        if($requirement = $this->cmsService->cmsStore($request->validated()))
        {
            activity()
                ->performedOn($requirement)
                ->causedBy(Auth::user())
                ->log('Requirement created by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.requirements.index')
                ->with('success', 'Requirement named ' . $requirement->name . ' created successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Requirement creation failed by: ' . Auth::user()->id);
            
            return redirect()
                ->back()
                ->with('failed', 'Requirement creation failed');
        }
    }
    
    public function update(CmsRequest $request, Requirement $requirement)
    {
        $request->merge(['cms_table' => 'requirements', 'id' => $requirement->id]);
        if($requirement = $this->cmsService->cmsUpdate($request->validated(), $requirement->id))
        {
            activity()
                ->performedOn($requirement)
                ->causedBy(Auth::user())
                ->log('Requirement updated by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.requirements.index')
                ->with('success', 'Requirement named ' . $requirement->name . ' updated successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Requirement creation failed by: ' . Auth::user()->id);
            
            return redirect()
                ->back()
                ->with('failed', 'Requirement creation failed');
        }
    }
    
    public function destroy(Requirement $requirement)
    {
        $requirementName = $requirement->name;
        
        if ($this->cmsService->cmsDestroy($requirement->id)) {
            activity()
                ->causedBy(Auth::user())
                ->log('Requirement deleted by: ' . Auth::user()->id);
    
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.requirements.index')
                ->with('success', 'Requirement named ' . $requirementName . ' deleted successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Requirement deletion failed by: ' . Auth::user()->id);
    
            return redirect()
                ->back()
                ->with('failed', 'Requirement deletion failed');
        }
    }
}
