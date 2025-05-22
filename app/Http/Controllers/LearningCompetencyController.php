<?php

namespace App\Http\Controllers;

use App\Models\learningCompetency;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Models\LearningDomain;
use App\Services\CmsService;

class LearningCompetencyController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'competency';

    public function __construct()
    {
        $this->cmsService = new CmsService(learningCompetency::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Learning competency';
        $resource = $this->resource;
        $columns = ['id', 'name', 'domain', 'remarks', 'Action'];
        $data = learningCompetency::getAllLearningCompetencies();
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
    
    public function update(CmsRequest $request, learningCompetency $competency)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $competency->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(learningCompetency $competency)
    {
        $destroy = $this->cmsService->cmsDestroy($competency->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
