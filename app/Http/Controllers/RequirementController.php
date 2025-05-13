<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class RequirementController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'requirement';
    protected string $table = 'requirements';

    public function __construct()
    {
        $this->cmsService = new CmsService(Requirement::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Requirement';
        $resource = 'requirement';
        $columns = ['name', 'remarks', 'action'];
        $data = Requirement::getAllRequirements();

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
    
    public function update(CmsRequest $request, Requirement $requirement)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $requirement->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $requirement->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Requirement $requirement)
    {
        $destroy = $this->cmsService->cmsDestroy($requirement->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
