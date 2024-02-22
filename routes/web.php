<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\DistrictStaffController;
use App\Http\Controllers\QuestioncategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarkingController;
use App\Http\Controllers\MarkingCriteriaController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SettingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
   
    Route::get('/user/home', [HomeController::class, 'userHome'])->name('user.home');
    Route::post('/user/reset-password', [ResetPasswordController::class, 'changePassword'])->name('user.reset');

    Route::get('/user/profile', [ProfileController::class, 'userProfile'])->name('user.profile');

    Route::get('user/practice/{id}/delete', [PracticeController::class,'destroy']);
    Route::resource('user/practice', PracticeController::class);

    Route::get('user/answer/{id}/delete', [AnswerController::class,'destroy']);
    Route::resource('user/answer', AnswerController::class);
    
    // files Route
    Route::get('user/files/{id}/delete', [FilesController::class,'destroy']);
    Route::resource('user/files', FilesController::class);
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::post('/admin/reset-password', [ResetPasswordController::class, 'changePassword'])->name('admin.reset');

    Route::get('admin/province/{id}/delete', [ProvinceController::class,'destroy']);
    Route::resource('admin/province', ProvinceController::class);

    Route::get('admin/district/{id}/delete', [DistrictController::class,'destroy']);
    Route::resource('admin/district', DistrictController::class);

    Route::post('admin/questioncategory/copy', [QuestioncategoryController::class,'copyCategory']);
    Route::get('admin/questioncategory/', [QuestioncategoryController::class,'yearSelect']);
    Route::get('admin/questioncategory/{year}/delete/{id}', [QuestioncategoryController::class,'destroy']);
    Route::get('admin/category/year/{year}', [QuestioncategoryController::class,'categoriesYear']);
    Route::resource('admin/category', QuestioncategoryController::class);

    Route::get('admin/question/{id}/show',[QuestionController::class,'show']);
    Route::get('admin/question/{id}/edit',[QuestionController::class,'edit']);
    Route::put('admin/question/{id}/update',[QuestionController::class,'update']);
    Route::get('admin/question/all/',[QuestionController::class,'all_questions']);
    Route::get('admin/year/question/', [QuestionController::class,'yearsSelect']);
    Route::post('admin/copy/question/', [QuestionController::class,'question_copy']);

    Route::get('admin/question/{year}/delete/{id}', [QuestionController::class,'destroy']);
    Route::resource('admin/question/{year}/', QuestionController::class);



    Route::resource('admin/marking/criteria',MarkingCriteriaController::class);

    Route::get('admin/district_staff/{id}/delete', [DistrictStaffController::class,'destroy']);
    Route::resource('admin/district_staff', DistrictStaffController::class);

    Route::get('admin/evaluator/{id}/delete', [EvaluatorController::class,'destroy']);
    Route::resource('admin/evaluator', EvaluatorController::class);

    // Route::get('admin/practice/{id}/delete', [PracticeController::class,'destroy']);
    // Route::resource('admin/practice', PracticeController::class);
    Route::get('admin/report/', [MarkingController::class,'obtainedMarks']);
    // answers
    Route::get('admin/answer/districts', [MarkingController::class,'answersDistricts']);
    Route::get('admin/answers/districts/{id}', [MarkingController::class,'answers']);

    Route::get('admin/report/districts', [MarkingController::class,'reportDistricts']);
    Route::get('admin/report/evaluators/district/{id}', [MarkingController::class,'evaluation']);

    Route::get('/admin/profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');

    Route::resource('/admin/setting', SettingController::class);
    Route::get('admin/setting/{id}/dates', [SettingController::class,'datesCreate']);

    Route::put('admin/setting/{id}/dates/store', [SettingController::class,'datesStore'])->name('admin.settings.dates');
    
    Route::put('admin/setting/{id}/activate', [SettingController::class,'yearActivate'])->name('admin.settings.year.active');

});
   
//Evaluator Routes List
Route::middleware(['auth', 'user-access:evaluator'])->group(function () {
   
    Route::get('/evaluator/home', [HomeController::class, 'evaluatorHome'])->name('evaluator.home');
    Route::post('/evaluator/reset-password', [ResetPasswordController::class, 'changePassword'])->name('evaluator.reset');

    // marking routes
    Route::resource('evaluator/marking', MarkingController::class);
    Route::get('evaluator/marking/{id}/practices', [MarkingController::class,'disrictPracties'])->name('marking.district.practices');
    Route::get('evaluator/marking/{district}/practices/{practice}', [MarkingController::class,'show'])->name('marking.practice');

    Route::get('/evaluator/profile', [ProfileController::class, 'evaluatorProfile'])->name('evaluator.profile');

});