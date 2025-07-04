<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\District;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class BarangayController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'barangay';

    public function __construct()
    {
        $this->cmsService = new CmsService(Barangay::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Barangay';
        $resource = $this->resource;
        $columns = ['id', 'name', 'district', 'remarks', 'Action'];
        $data = Barangay::getAllBarangays();
        $subRecords = District::getAllDistricts();

        return $dataTable->render('cms.index', compact(
            'page_title',
            'resource',
            'columns',
            'data',
            'subRecords',
            'dataTable'
        ));
    }
    
    public function store(CmsRequest $request)
    {
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Barangay $barangay)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $barangay->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Barangay $barangay)
    {
        $destroy = $this->cmsService->cmsDestroy($barangay->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
