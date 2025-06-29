<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildEducPlanRequest;
use App\Http\Requests\ProgressReportRequest;
use App\Models\ChildEducationalPlan;
use App\Models\ChildFamily;
use App\Models\ChildInfo;
use App\Models\Files;
use App\Models\Goal;
use App\Models\LearningDomain;
use App\Models\ParentsInfo;
use App\Models\ProgressReport;
use App\Models\Rating;
use App\Models\Requirement;
use App\Models\User;
use App\Services\ChildRatingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use App\DataTables\CmsDataTable;

class ChildController extends Controller
{
    protected $childRatingService;

    public function __construct(ChildRatingService $childRatingService)
    {
        $this->childRatingService = $childRatingService;
    }
    
    public function childProfile(ChildInfo $child)
    {
        $childId = $child->id;

        
        $existingFiles = Files::where([
            ['imageable_type', ChildInfo::class],
            ['imageable_id',   $childId ?? ''],
            ])->get()->keyBy('remarks');

        $motherInfo = ParentsInfo::getMotherInfo($childId);
        $fatherInfo = ParentsInfo::getFatherInfo($childId);
        $family     = ChildFamily::getFamilyPerChild($childId);
        $requirements = Requirement::getAllRequirements();

        return view('children.profile', compact(
            'motherInfo', 
            'fatherInfo', 
            'family', 
            'child', 
            'requirements', 
            'existingFiles',
        ));
    }

    public function childEducationalPlan(ChildInfo $child)
    {
        $domains = LearningDomain::with('goal')
                ->where('name', '!=', 'Gross motor')
                ->get();
        $ratings = Rating::select('id', 'name', 'remarks')->get();
        $educPlan = ChildEducationalPlan::getChildEducationalPlan($child->id)
                    ->pluck('rating_id', 'objective_id');
        return view('children.educationalPlan', compact(
            'child',
            'domains',
            'ratings',
            'educPlan'
        ));
    }

    public function storeChildEducationalPlan(ChildInfo $child, ChildEducPlanRequest $request)
    {
        $records = $this->childRatingService->storeChildEducPlan($request->validated(), $child);

        foreach ($records as $record) {
            activity()
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->log('User ' . Auth::user()->name . ' rated objective ' . $record->objective_id . ' for ' . $child->first_name . ' ' . $child->last_name);
        }

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.educational.index', $child->id)
            ->with('success', 'You have successfully created an educational plan!');
    }

    public function childProgressReport(ChildInfo $child)
    {
        $domains = LearningDomain::with('learningCompetency')->get();
        $ratings = Rating::all();
        $progress = ProgressReport::getChildProgressReport($child->id)
                    ->pluck('rate_id', 'competency_id');

        return view('children.progressReport', compact(
            'child',
            'domains',
            'ratings',
            'progress',
        ));
    }

    public function storeProgressReport(ChildInfo $child, ProgressReportRequest $request)
    {
        $records = $this->childRatingService->storeChildProgressReport($request->validated(), $child);

        foreach ($records as $record) {
        activity()
            ->performedOn($record)
            ->causedBy(Auth::user())
                ->log('User ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' rated a learning competency ' . $record->competency_id . ' for ' . $child->first_name . ' ' . $child->last_name);
        }       

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.children.profile', $child->id)
            ->with('success', 'You have successfully submitted a progress report!');
    }

    public function childrenList(CmsDataTable $dataTable)
    {
        $childrens = ChildInfo::getAllChildNames();
        $columns = ['Id', 'Full name', 'Status', 'Date applied','Action'];
        return $dataTable->render('children.list', compact(
            'dataTable',
            'childrens',
            'columns',
        ));
    }

    public function generateId(ChildInfo $child)
    {
        $childId = $child->id;

        $templatePath = public_path('images/front_id.webp');
        $img = Image::read($templatePath);
        $file = $child->files->where('remarks', 8)->first();

        if($file)
        {
            $overlayPath = $child->files->where('remarks', 8)->first()->file_path; 
            $overlay = Image::read($overlayPath);
            
            $overlay->resize(340,340);
            
            $img->place($overlay, 'center', 0, 0);

            $name = trim($child->first_name . ' ' . $child->middle_name . ' ' . $child->last_name);

            $img->text($name, $img->width() / 2, 800, function($font) {
                $font->file(public_path('fonts/Roboto-Italic-VariableFont_wdth,wght.ttf'));
                $font->size(40);
                $font->color('#000000');
                $font->align('center');
                $font->valign('top');
            });
            
            $generatedFilename = "front_id_{$childId}.png";
            $img->save(public_path("images/generated/{$generatedFilename}"));

            $front_id = Files::updateOrCreate(
                [
                    'imageable_type' => ChildInfo::class,
                    'imageable_id'   => $childId,
                    'remarks'        => 'front_id',
                ],
                [
                    'file_path' => "images/generated/{$generatedFilename}",
                    'file_name' => $generatedFilename,
                    'file_type' => 'image/jpeg',
                ]
            );
        }

        activity()
            ->performedOn($front_id)
            ->causedBy(Auth::user()->id)
            ->log('User: ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' generated an ID for ' . $child->first_name . ' ' . $child->last_name );

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.children.profile', $child->id)
            ->with('success', 'You have successfully generated an Id!');
    }
}