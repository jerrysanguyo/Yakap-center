<?php

namespace App\Http\Controllers\Cms;

use App\Models\Privacy;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'privacy';

    public function __construct()
    {
        $this->cmsService = new CmsService(Privacy::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Privacy Policy';
        $resource = 'privacy';
        $columns = ['id', 'name', 'remarks', 'action'];
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
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Privacy $privacy)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $privacy->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Privacy $privacy)
    {
        $destroy = $this->cmsService->cmsDestroy($privacy->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
