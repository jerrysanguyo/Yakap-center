<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class DistrictController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'district';
    protected string $table = 'districts';

    public function __construct()
    {
        $this->cmsService = new CmsService(District::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Districts';
        $resource = $this->resource;
        $columns = ['id', 'name', 'remarks', 'actions'];
        $data = District::getAllDistricts();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, District $district)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $district->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $district->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(District $district)
    {
        $destroy = $this->cmsService->cmsDestroy($district->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}