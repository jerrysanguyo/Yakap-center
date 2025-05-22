<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Models\LearningDomain;
use App\Services\CmsService;

class GoalController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'goal';

    public function __construct()
    {
        $this->cmsService = new CmsService(Goal::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Goal';
        $resource = $this->resource;
        $columns = ['id', 'name', 'domain', 'remarks', 'Action'];
        $data = Goal::getAllGoals();
        $subRecords = LearningDomain::getAllLearningDomains();

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
    
    public function update(CmsRequest $request, Goal $goal)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $goal->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Goal $goal)
    {
        $destroy = $this->cmsService->cmsDestroy($goal->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
