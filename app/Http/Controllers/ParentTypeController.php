<?php

namespace App\Http\Controllers;

use App\Models\ParentType;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use Illuminate\Support\Facades\Auth;

class ParentTypeController extends Controller
{
    protected CmsService $cmsService;

    public function __construct()
    {
        $this->cmsService = new CmsService(ParentType::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Parent Types';
        $resource = 'type';
        $column = ['name', 'remarks', 'Action'];
        $data = ParentType::getAllParentTypes();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'column',
                'data',
                'dataTable'
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => 'parent_types']);
        if($type = $this->cmsService->cmsStore($request->validated()))
        {
            activity()
                ->performedOn($type)
                ->causedBy(Auth::user())
                ->log('Parent Type created by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.parent_types.index')
                ->with('success', 'Parent Type named ' . $type->name . ' created successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Parent Type creation failed by: ' . Auth::user()->id);
            
            return redirect()
                ->back()
                ->with('failed', 'Parent Type creation failed');
        }
    }
    
    public function update(CmsRequest $request, ParentType $parentType)
    {
        $request->merge(['cms_table' => 'parent_types', 'id' => $parentType->id]);
        if($parentType = $this->cmsService->cmsUpdate($request->validated(), $parentType->id))
        {
            activity()
                ->performedOn($parentType)
                ->causedBy(Auth::user())
                ->log('Parent Type updated by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.parent_types.index')
                ->with('success', 'Parent Type named ' . $parentType->name . ' updated successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Parent Type update failed by: ' . Auth::user()->id);
            
            return redirect()
                ->back()
                ->with('failed', 'Parent Type update failed');
        }
    }
    
    public function destroy(ParentType $parentType)
    {
        $parentTypeName = $parentType->name;

        if ($this->cmsService->cmsDestroy($parentType->id)) {
            activity()
                ->performedOn($parentType)
                ->causedBy(Auth::user())
                ->log('Parent Type deleted by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.parent_types.index')
                ->with('success', 'Parent Type named ' . $parentTypeName . ' deleted successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Parent Type deletion failed by: ' . Auth::user()->id);
            
            return redirect()
                ->back()
                ->with('failed', 'Parent Type deletion failed');
        }
    }
}
