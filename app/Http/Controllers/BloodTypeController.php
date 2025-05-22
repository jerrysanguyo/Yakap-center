<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class BloodTypeController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'blood';

    public function __construct()
    {
        $this->cmsService = new CmsService(BloodType::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Blood type';
        $resource = $this->resource;
        $columns = ['id', 'name', 'remarks', 'Action'];
        $data = BloodType::getAllBloodTypes();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'columns',
                'data',
                'resource',
                'dataTable'
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, BloodType $blood)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $blood->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(BloodType $blood)
    {
        $destroy = $this->cmsService->cmsDestroy($blood->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
