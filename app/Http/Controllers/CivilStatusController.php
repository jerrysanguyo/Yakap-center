<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class CivilStatusController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'civil';
    protected string $table = 'civil_statuses';

    public function __construct()
    {
        $this->cmsService = new CmsService(CivilStatus::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Civil status';
        $resource = $this->resource;
        $column = ['id', 'name', 'remarks', 'action'];
        $data = CivilStatus::getAllCivilStatuses();

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
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, CivilStatus $civilStatus)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $civilStatus->id]);
        $update = $this->cmsService->cmsUpdate($request->validated, $civilStatus->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(CivilStatus $civilStatus)
    {
        $destroy = $this->cmsService->cmsDestroy($civilStatus->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
