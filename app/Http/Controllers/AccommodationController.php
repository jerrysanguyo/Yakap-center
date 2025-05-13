<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class AccommodationController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'Accommodation';
    protected string $table = 'Accommodations';

    public function __construct()
    {
        $this->cmsService = new CmsService(Accommodation::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Accommodation';
        $resource = $this->resource;
        $column = ['id', 'name', 'objective', 'Action'];
        $data = Accommodation::getAllAccommodations();

        return $dataTable
            ->render('cms.view', compact(
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
    
    public function update(CmsRequest $request, Accommodation $accommodation)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $accommodation->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $accommodation->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Accommodation $accommodation)
    {
        $destroy = $this->cmsService->cmsDestroy($accommodation->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
