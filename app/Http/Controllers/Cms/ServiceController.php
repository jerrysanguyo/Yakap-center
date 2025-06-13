<?php

namespace App\Http\Controllers\Cms;

use App\Models\Service;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'service';

    public function __construct()
    {
        $this->cmsService = new CmsService(Service::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Service';
        $resource = 'service';
        $columns = ['id', 'name', 'remarks', 'action'];
        $data = Service::getAllServices();

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
    
    public function update(CmsRequest $request, Service $service)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $service->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Service $service)
    {
        $destroy = $this->cmsService->cmsDestroy($service->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
