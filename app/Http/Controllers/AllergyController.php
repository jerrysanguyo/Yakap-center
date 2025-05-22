<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class AllergyController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'allergy';
    protected string $table = 'allergies';

    public function __construct()
    {
        $this->cmsService = new CmsService(Allergy::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Allergy';
        $resource = $this->resource;
        $columns = ['id', 'name', 'remarks', 'Action'];
        $data = Allergy::getAllAllergies();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'columns',
                'data',
                'resource',
                'dataTable'
            ));
    }
    
    public function store(CmsRequest $request)
    {
        $store = $this->cmsService->cmsStore($request->validated());

        return $this->cmsService->handleRedirect($store, $this->resource, 'created');
    }
    
    public function update(CmsRequest $request, Allergy $allergy)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $allergy->id);

        return $this->cmsService->handleRedirect($update, $this->resource, 'updated');
    }
    
    public function destroy(Allergy $allergy)
    {
        $destroy = $this->cmsService->cmsDestroy($allergy->id);

        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
