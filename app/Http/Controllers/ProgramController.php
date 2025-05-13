<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;

class ProgramController extends Controller
{
    protected CmsService $cmsService;
    protected string $resource = 'program';
    protected string $table = 'programs';

    public function __construct()
    {
        $this->cmsService = new CmsService(Program::class);
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Program';
        $resource = 'program';
        $columns = ['name', 'remarks', 'action'];
        $data = Program::getAllProgram();

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
    
    public function update(CmsRequest $request, Program $program)
    {
        $request->merge(['cms_table' => $this->table, 'id' => $program->id]);
        $update = $this->cmsService->cmsUpdate($request->validated(), $program->id);

        return $this->cmsService->handleRedirect($update, $this->resource,  'updated');
    }
    
    public function destroy(Program $program)
    {
        $destroy = $this->cmsService->cmsDestroy($program->id);
        
        return $this->cmsService->handleRedirect($destroy, $this->resource, 'deleted');
    }
}
