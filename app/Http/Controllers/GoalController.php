<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class GoalController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'program';
    protected string $table = 'programs';

    public function __construct()
    {
        $this->cmsService = new CmsService(Goal::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Goal';
        $resource = $this->resource;
        $column = ['id', 'name', 'district', 'Action'];
        $data = Goal::getAllGoals();

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
    
    public function update(CmsRequest $request, Goal $goal)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $goal->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $goal->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Goal $goal)
    {
        $destroy = $this->cmsService->cmsDestroy($goal->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
