<?php

namespace App\Http\Controllers;

use App\Models\LearningDomain;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class LearningDomainController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'domain';

    public function __construct()
    {
        $this->cmsService = new CmsService(LearningDomain::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Learning Domain';
        $resource = $this->resource;
        $columns = ['id', 'name', 'domain', 'Action'];
        $data = LearningDomain::getAllLearningDomains();

        return $dataTable->render('cms.index', compact(
            'page_title',
            'resource',
            'columns',
            'data',
            'dataTable'
        ));
    }

    public function store(CmsRequest $request)
    {
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, LearningDomain $domain)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $domain->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(LearningDomain $domain)
    {
        $destroy = $this->cmsService->cmsDestroy($domain->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}