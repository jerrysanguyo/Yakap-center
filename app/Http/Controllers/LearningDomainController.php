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
    protected string $table = 'learning_domains';

    public function __construct()
    {
        $this->cmsService = new CmsService(LearningDomain::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Learning Domain';
        $resource = $this->resource;
        $column = ['id', 'name', 'district', 'Action'];
        $data = LearningDomain::getAllLearningDomains();

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
    
    public function update(CmsRequest $request, LearningDomain $domain)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $domain->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $domain->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(LearningDomain $domain)
    {
        $destroy = $this->cmsService->cmsDestroy($domain->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}