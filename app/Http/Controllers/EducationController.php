<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class EducationController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'education';
    protected string $table = 'educations';

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
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Education $education)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $education->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $education->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(Education $education)
    {
        $destroy = $this->cmsService->cmsDestroy($education->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}