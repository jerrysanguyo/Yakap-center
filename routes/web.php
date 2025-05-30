<?php

use App\Http\Controllers\BloodTypeController;
use App\Http\Controllers\AllergyController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\DisabilityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\LearningCompetencyController;
use App\Http\Controllers\LearningDomainController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\ParentTypeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\ServiceController;
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
                Route::get('/activity-logs', [ActivityLog::class, 'index'])->name('log.index');
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/enrollment', [EnrollmentController::class, 'index'])->name('enrollment.index');
                Route::get('consent-form', [EnrollmentController::class, 'consentForm'])->name('consent.index');
                Route::post('consent-form/store', [EnrollmentController::class, 'consentStore'])->name('consent.store');
                Route::post('enrollment/child-info/store', [EnrollmentController::class, 'storeChildInfo'])->name('childInfo.store');
                Route::post('enrollment/guardia-info/store', [EnrollmentController::class, 'storeGuardianInfo'])->name('guardianInfo.store');
                Route::post('enrollment/disability-info/store', [EnrollmentController::class, 'storeDisabilityInfo'])->name('disabilityInfo.store');
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
                Route::resource('blood', BloodTypeController::class)->middleware('merge_cms:blood_types');
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
            });
    });