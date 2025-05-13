<?php

namespace App\Http\Controllers;

use App\Models\ParentType;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ParentTypeController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'parentType';
    protected string $table = 'parent_types';

    public function __construct()
    {
        $this->cmsService = new CmsService(ParentType::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Parent type';
        $resource = 'ParentType';
        $columns = ['name', 'remarks', 'action'];
        $data = ParentType::getAllParentType();

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
        $request->merge(['cms_table' => $this->table]);
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, ParentType $parentType)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $parentType->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $parentType->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(ParentType $parentType)
    {
        $destroy = $this->cmsService->cmsDestroy($parentType->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
