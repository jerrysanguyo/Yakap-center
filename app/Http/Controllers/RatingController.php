<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class RatingController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'rating';

    public function __construct()
    {
        $this->cmsService = new CmsService(Rating::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Rating';
        $resource = 'rating';
        $columns = ['id', 'name', 'remarks', 'action'];
        $data = Rating::getAllRatings();

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
    
    public function update(CmsRequest $request, Rating $rating)
    {
        $update = $this->cmsService->cmsUpdate($request->validated(), $rating->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Rating $rating)
    {
        $destroy = $this->cmsService->cmsDestroy($rating->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
