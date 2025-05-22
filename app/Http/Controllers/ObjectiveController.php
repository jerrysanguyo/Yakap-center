<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Objective;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ObjectiveController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'objective';

    public function __construct()
    {
        $this->cmsService = new CmsService(Objective::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Objective';
        $resource = $this->resource;
        $columns = ['id', 'name', 'goal', 'remarks', 'Action'];
        $data = Objective::getAllObjectives();
        $subRecords = Goal::getAllGoals();

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
    
    public function update(CmsRequest $request, Objective $objective)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $objective->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Objective $objective)
    {
        $destroy = $this->cmsService->cmsDestroy($objective->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
