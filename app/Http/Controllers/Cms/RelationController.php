<?php

namespace App\Http\Controllers\Cms;

use App\Models\Relation;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use App\Http\Controllers\Controller;


class RelationController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'relation';

    public function __construct()
    {
        $this->cmsService = new CmsService(Relation::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Relation';
        $resource = 'relation';
        $columns = ['id', 'name', 'remarks', 'action'];
        $data = Relation::getAllRelations();

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
    
    public function update(CmsRequest $request, Relation $relation)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $relation->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Relation $relation)
    {
        $destroy = $this->cmsService->cmsDestroy($relation->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
