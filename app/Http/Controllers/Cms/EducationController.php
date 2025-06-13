<?php

namespace App\Http\Controllers\Cms;

use App\Models\Education;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'education';

    public function __construct()
    {
        $this->cmsService = new CmsService(Education::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Educations';
        $resource = $this->resource;
        $columns = ['id', 'name', 'remarks', 'actions'];
        $data = Education::getAllEducations();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Education $education)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $education->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(Education $education)
    {
        $destroy = $this->cmsService->cmsDestroy($education->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}