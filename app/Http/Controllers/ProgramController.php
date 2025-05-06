<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\CmsRequest;
use App\DataTables\CmsDataTable;
use App\Services\CmsService;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    protected CmsService $cmsService;

    public function __construct()
    {
        $this->cmsService = new CmsService(Program::class);
    }

    public function index()
    {
        $page_title = 'Program';
        $resource = 'program';
        $columns = ['name', 'remarks', 'action'];
        $data = Program::getAllPrograms();

        return view('cms.index', compact(
            'page_title',
            'resource',
            'columns',
            'data',
            'dataTable'
        ));
    }
    
    public function store(CmsRequest $request)
    {
        $request->merge(['cms_table' => 'programs']);
        if($program = $this->cmsService->cmsStore($request->validated()))
        {
            activity()
                ->performedOn($program)
                ->causedBy(Auth::user())
                ->log('Program named ' . $program->name . ' created successfully by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.program.index')
                ->with('success', 'Program named ' . $program->name . ' created successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Program creation failed by: ' . Auth::user()->id);
            return redirect()
                ->back()
                ->with('failed', 'Program creation failed');
        }
    }
    
    public function update(CmsRequest $request, Program $program)
    {
        $request->merge(['cms_table' => 'programs', 'id' => $program->id]);
        if($program = $this->cmsService->cmsUpdate($request->validated()))
        {
            activity()
                ->performedOn($program)
                ->causedBy(Auth::user())
                ->log('Program named ' . $program->name . ' updated successfully by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.program.index')
                ->with('success', 'Program named ' . $program->name . ' updated successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Program named ' . $program->name . ' was failed to update by: ' . Auth::user()->id);
            return redirect()
                ->back()
                ->with('failed', 'Program update failed');
        }
    }
    
    public function destroy(Program $program)
    {
        $programName = $program->name;

        if($program = $this->cmsService->cmsDestroy($program->id))
        {
            activity()
                ->performedOn($program)
                ->causedBy(Auth::user())
                ->log('Program named ' . $programName . ' deleted successfully by: ' . Auth::user()->id);

            return redirect()
                ->route(Auth::user()->getRoleNames()->first() . '.program.index')
                ->with('success', 'Program named ' . $programName . ' deleted successfully');
        } else {
            activity()
                ->causedBy(Auth::user())
                ->log('Program named ' . $programName . ' was failed to delete by: ' . Auth::user()->id);
            return redirect()
                ->back()
                ->with('failed', 'Program deletion failed');
        }
    }
}
