<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ServiceController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'Service';
    protected string $table = 'Services';

    public function __construct()
    {
        $this->cmsService = new CmsService(Service::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Service';
        $resource = 'Service';
        $columns = ['name', 'remarks', 'action'];
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
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Service $service)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $service->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $service->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Service $service)
    {
        $destroy = $this->cmsService->cmsDestroy($service->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
