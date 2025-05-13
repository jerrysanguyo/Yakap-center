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
    protected string $table = 'blood_types';

    public function __construct()
    {
        $this->cmsService = new CmsService(BloodType::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_tite = 'Blood type';
        $resource = $this->resource;
        $column = ['id', 'name', 'remarks', 'Action'];
        $data = BloodType::getAllBloodTypes();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'column',
                'data',
                'resource',
                'dataTable'
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, BloodType $bloodType)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $bloodType->id]);
        $update = $this->cmsService->cmsUpdate($request->validated());

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(BloodType $bloodType)
    {
        $destroy = $this->cmsService->cmsDestroy($bloodType->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
