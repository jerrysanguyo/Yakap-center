<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class PrivacyController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'privacy';
    protected string $table = 'privacies';

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
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Privacy $privacy)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $privacy->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $privacy->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Privacy $privacy)
    {
        $destroy = $this->cmsService->cmsDestroy($privacy->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
