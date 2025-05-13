<?php

namespace App\Http\Controllers;

use App\Models\Disability;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class DisabilityController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'disability';
    protected string $table = 'disabilities';

    public function __construct()
    {
        $this->cmsService = new CmsService(Disability::class);
    }
    
    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Disability';
        $resource = $this->resource;
        $column = ['id', 'name', 'remarks', 'action'];
        $data = Disability::getAllDisabilities();

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
    
    public function update(CmsRequest $request, Disability $disability)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $disability->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $disability->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(Disability $disability)
    {
        $destroy = $this->cmsService->cmsDestroy($disability->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
