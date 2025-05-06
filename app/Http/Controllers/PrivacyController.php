<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{
    protected CmsService $cmsService;

    public function __construct()
    {
        $this->cmsService = new CmsService(Privacy::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Privacy Policy';
        $resource = 'privacy';
        $columns = ['name', 'remarks', 'action'];
        $data = Privacy::getAllPrivacy();

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
        $request->merge(['cms_type' => 'privacy']);
        if($privacy = $this->cmsService->store($request->validated()))
        {
            activity()
                ->performedOn($privacy)
                ->causedBy(Auth::user())
                ->log('Privacy named ' . $privacy->name . 'created by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('success', 'Privacy named ' . $privacy->name . ' created successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Privacy creation failed by: ' . Auth::user()->id);
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('failed', 'Privacy creation failed');
        }
    }

    public function update(CmsRequest $request, Privacy $privacy)
    {
        $request->merge(['cms_type' => 'privacy', 'id' => $privacy->id]);
        if($privacy = $this->cmsService->cmsUpdate($request->validated(), $privacy->id))
        {
            activity()
                ->performedOn($privacy)
                ->causedBy(Auth::user())
                ->log('Privacy updated by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('success', 'Privacy named ' . $privacy->name . ' updated successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Program named ' . $privacy->name . ' was failed to update by: ' . Auth::user()->id);
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('failed', 'Privacy update failed');
        }
    }
    
    public function destroy(Privacy $privacy)
    {
        $privacyName = $privacy->name;
        if($this->cmsService->cmsDelete($privacy->id))
        {
            activity()
                ->performedOn($privacy)
                ->causedBy(Auth::user())
                ->log('Privacy deleted by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('success', 'Privacy named ' . $privacyName . ' deleted successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Program named ' . $privacyName . ' was failed to delete by: ' . Auth::user()->id);
            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.privacy.index')
                ->with('failed', 'Privacy deletion failed');
        }
    }
}
