<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    protected $scheduleService;
    
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(User $parent)
    {
        return view('schedule.index');
    }
    
    public function store(ScheduleRequest $request, $parent)
    {
        $parentId = $parent->id;
        $storeSched = $this->scheduleService->storeSched($request->validated());
        
        activity()
            ->performedOn($storeSched)
            ->causedBy(Auth::user()->id)
            ->log('User: ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' set a schedule for parent: ' . $parentId . ' successfully!' );

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.shedule.index')
            ->with('success', 'You have successfully added a schedule successfully!');
    }
    
    public function destroy(Schedule $schedule)
    {
        $this->scheduleService->destroySched($schedule);
        
        activity()
            ->causedBy(Auth::user()->id)
            ->log('User: ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' deleted a schedule successfully!' );

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.shedule.index')
            ->with('success', 'You have deleted a schedule successfully!');
    }
}
