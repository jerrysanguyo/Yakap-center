<?php

namespace App\Http\Controllers;

use App\Models\ParentType;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ParentTypeController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'parent';

    public function __construct()
    {
        $this->cmsService = new CmsService(ParentType::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Parent type';
        $resource = 'parent';
        $columns = ['id', 'name', 'remarks', 'action'];
        $data = ParentType::getAllParentTypes();

        return $dataTable
            ->render('cms.index', compact(
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
    
    public function update(CmsRequest $request, ParentType $parent)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $parent->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(ParentType $parent)
    {
        $destroy = $this->cmsService->cmsDestroy($parent->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
