<?php

use App\Http\Controllers\Cms\{
    BloodTypeController,
    AllergyController,
    CivilStatusController,
    DisabilityController,
    DistrictController,
    BarangayController,
    EducationController,
    GenderController,
    GoalController,
    LearningCompetencyController,
    LearningDomainController,
    ObjectiveController,
    ParentTypeController,
    PrivacyController,
    ProgramController,
    RatingController,
    RelationController,
    ServiceController,
};

use App\Http\Controllers\ChildController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ActivityLog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])
    ->group(function () {

        Route::middleware('role:superadmin')
            ->prefix('sa')
            ->name('superadmin.')
            ->group(function () {
                Route::get('/children-profile', [ChildController::class, 'index'])->name('children.profile');
                Route::get('/activity-logs', [ActivityLog::class, 'index'])->name('log.index');
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/consent-form', [EnrollmentController::class, 'consentForm'])->name('consent.index');
                Route::post('/consent-form/store', [EnrollmentController::class, 'consentStore'])->name('consent.store');
                Route::get('/enrollment-form', [EnrollmentController::class, 'index'])->name('enrollment.index');
                Route::post('/enrollment/store', [EnrollmentController::class, 'enrollmentStore'])->name('enrollment.store');
                Route::get('/requirements-form', [EnrollmentController::class, 'requirementsForm'])->name('requirement.index');
                Route::post('/requirement/store', [EnrollmentCOntroller::class, 'requirementStore'])->name('requirement.store');
                Route::resource('blood', BloodTypeController::class)->middleware('merge_cms:blood_types,blood');
                Route::resource('allergy', AllergyController::class)->middleware('merge_cms:allergies,allergy');
                Route::resource('civil', CivilStatusController::class)->middleware('merge_cms:civil_statuses,civil');
                Route::resource('disability', DisabilityController::class)->middleware('merge_cms:disabilities,disability');
                Route::resource('district', DistrictController::class)->middleware('merge_cms:districts,district');
                Route::resource('barangay', BarangayController::class)->middleware('merge_cms:barangays,barangay');
                Route::resource('education', EducationController::class)->middleware('merge_cms:educations,education');
                Route::resource('gender', GenderController::class)->middleware('merge_cms:genders,gender');
                Route::resource('goal', GoalController::class)->middleware('merge_cms:goals,goal');
                Route::resource('domain', LearningDomainController::class)->middleware('merge_cms:learning_domains,domain');
                Route::resource('competency', LearningCompetencyController::class)->middleware('merge_cms:learning_competencies,competency');
                Route::resource('objective', ObjectiveController::class)->middleware('merge_cms:objectives,objective');
                Route::resource('parent', ParentTypeController::class)->middleware('merge_cms:parent_types,parent');
                Route::resource('privacy', PrivacyController::class)->middleware('merge_cms:privacies,privacy');
                Route::resource('program', ProgramController::class)->middleware('merge_cms:programs,program');
                Route::resource('rating', RatingController::class)->middleware('merge_cms:ratings,rating');
                Route::resource('relation', RelationController::class)->middleware('merge_cms:relations,relation');
                Route::resource('service', ServiceController::class)->middleware('merge_cms:services,service');
            });

        Route::middleware('role:admin')
            ->prefix('ad')
            ->name('admin.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/consent-form', [EnrollmentController::class, 'consentForm'])->name('consent.index');
                Route::post('/consent-form/store', [EnrollmentController::class, 'consentStore'])->name('consent.store');
                Route::get('/enrollment-form', [EnrollmentController::class, 'index'])->name('enrollment.index');
                Route::post('/enrollment/store', [EnrollmentController::class, 'enrollmentStore'])->name('enrollment.store');
                Route::get('/requirements-form', [EnrollmentController::class, 'requirementsForm'])->name('requirement.index');
                Route::post('/requirement/store', [EnrollmentCOntroller::class, 'requirementStore'])->name('requirement.store');
                Route::resource('blood', BloodTypeController::class)->middleware('merge_cms:blood_types,blood');
                Route::resource('allergy', AllergyController::class)->middleware('merge_cms:allergies,allergy');
                Route::resource('civil', CivilStatusController::class)->middleware('merge_cms:civil_statuses,civil');
                Route::resource('disability', DisabilityController::class)->middleware('merge_cms:disabilities,disability');
                Route::resource('district', DistrictController::class)->middleware('merge_cms:districts,district');
                Route::resource('barangay', BarangayController::class)->middleware('merge_cms:barangays,barangay');
                Route::resource('education', EducationController::class)->middleware('merge_cms:educations,education');
                Route::resource('gender', GenderController::class)->middleware('merge_cms:genders,gender');
                Route::resource('goal', GoalController::class)->middleware('merge_cms:goals,goal');
                Route::resource('domain', LearningDomainController::class)->middleware('merge_cms:learning_domains,domain');
                Route::resource('competency', LearningCompetencyController::class)->middleware('merge_cms:learning_competencies,competency');
                Route::resource('objective', ObjectiveController::class)->middleware('merge_cms:objectives,objective');
                Route::resource('parent', ParentTypeController::class)->middleware('merge_cms:parent_types,parent');
                Route::resource('privacy', PrivacyController::class)->middleware('merge_cms:privacies,privacy');
                Route::resource('program', ProgramController::class)->middleware('merge_cms:programs,program');
                Route::resource('rating', RatingController::class)->middleware('merge_cms:ratings,rating');
                Route::resource('relation', RelationController::class)->middleware('merge_cms:relations,relation');
                Route::resource('service', ServiceController::class)->middleware('merge_cms:services,service');
            });

        Route::middleware('role:user')
            ->prefix('us')
            ->name('user.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/consent-form', [EnrollmentController::class, 'consentForm'])->name('consent.index');
                Route::post('/consent-form/store', [EnrollmentController::class, 'consentStore'])->name('consent.store');
                Route::get('/enrollment-form', [EnrollmentController::class, 'index'])->name('enrollment.index');
                Route::post('/enrollment/store', [EnrollmentController::class, 'enrollmentStore'])->name('enrollment.store');
                Route::get('/requirements-form', [EnrollmentController::class, 'requirementsForm'])->name('requirement.index');
                Route::post('/requirement/store', [EnrollmentCOntroller::class, 'requirementStore'])->name('requirement.store');
            });
    });