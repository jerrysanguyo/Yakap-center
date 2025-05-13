<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ObjectiveController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'objective';
    protected string $table = 'objectives';

    public function __construct()
    {
        $this->cmsService = new CmsService(Objective::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Objective';
        $resource = $this->resource;
        $column = ['id', 'name', 'goal', 'Action'];
        $data = Objective::getAllObjectives();

        return $dataTable->render('cms.view', compact(
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
    
    public function update(CmsRequest $request, Objective $objective)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $objective->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $objective->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Objective $objective)
    {
        $destroy = $this->cmsService->cmsDestroy($objective->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
