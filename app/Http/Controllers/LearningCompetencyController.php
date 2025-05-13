<?php

namespace App\Http\Controllers;

use App\Models\learningCompetency;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class LearningCompetencyController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'competency';
    protected string $table = 'learning_competencies';

    public function __construct()
    {
        $this->cmsService = new CmsService(learningCompetency::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Learning competency';
        $resource = $this->resource;
        $column = ['id', 'name', 'domain', 'Action'];
        $data = learningCompetency::getAllLearningCompetencies();

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
    
    public function update(CmsRequest $request, learningCompetency $competency)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $competency->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $competency->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(learningCompetency $competency)
    {
        $destroy = $this->cmsService->cmsDestroy($competency->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
