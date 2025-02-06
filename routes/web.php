<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AllPacketController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SSOController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DifficultyLevelController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PacketFullController;
use App\Http\Controllers\PacketMiniController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizTypeController;
use App\Http\Controllers\StoryQuestionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'login')->name('loginPost');
});

Route::middleware('authenticated')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(AllPacketController::class)->group(function () {
        Route::get('/get-all-paket/full-test', 'index')->name('allpacket.index');
    });

    Route::controller(PacketFullController::class)->group(function () {
        Route::get('/get-all-paket/full-test', 'getFullPaket')->name('packetfull.first');
        Route::get('/data-packet-full/{id}', 'index')->name('packetfull.index');
        Route::get('/data-packet-full/{id}/search-question', 'searchQuestion')->name('packetfull.searchQuestion');
        Route::get('/entry-question-full/{id}', 'getEntryQuestionFull')->name('packetfull.entryQuestion');
        Route::patch('/edit-question/{id}', 'editQuestion')->name('packetfull.editQuestion');
        Route::post('/entry-question-full', 'postEntryQuestionFull')->name('packetfull.postEntryQuestion');
        Route::post('/entry-data-multiple/{id}', 'entryMultiple')->name('packetfull.entryMultiple');
        Route::post('/edit-answer/{id}/test', 'editAnswer')->name('packetfull.editAnswer');

        // entry nested question
        Route::get('/entry/nested-question/{id}', 'entryNestedFullQuestion')->name('packetfull.entryNested');
        Route::post('/entry/nested-question/{id}', 'addNestedFullQuestion')->name('packetfull.addNested');
        Route::get('/entrydata/nested-question/{idNested}/{idPacket}/get-all', 'getAllNested')->name('packetfull.getAllNested');
        Route::post('/entry/nested-question/{id}/add-data', 'storeDataNested')->name('packetfull.storeDataNested');
        Route::get('/entry/nested-question/{id}/deleted', 'deleteNestedQuestion')->name('packetfull.deleteNestedQuestion');
        Route::patch('/edit-nested/{id}', 'editNested')->name('packetfull.editNested');
        Route::get('/get-all-paket/search-packetFull', 'searchFullPaket')->name('packetfull.search');

    });

    Route::controller(PacketMiniController::class)->group(function () {
        Route::get('/get-all-paket/mini-test', 'getMiniPaket')->name('packetmini.first');
        Route::get('/data-packet-mini/{id}', 'index')->name('packetmini.index');
        Route::get('/entry-question-mini/{id}', 'getEntryQuestionMini')->name('packetmini.entryQuestion');
        Route::patch('/edit-packet/{id}', 'editPacket')->name('packetmini.edit');
        Route::get('/delete-packet/{id}', 'deletePacket')->name('packetmini.delete');
        Route::post('/add-packet', 'addPacket')->name('packetmini.store');
        Route::get('/get-all-paket/search-packetMini', 'searchMiniPaket')->name('packetmini.search');

    });

    Route::controller(StoryQuestionController::class)->group(function () {
        Route::get('/entry/nested-question', 'index')->name('entrynested.index');
    });

    Route::controller(UserRoleController::class)->group(function () {
        Route::get('/user-role', 'index')->name('userRole.index');
        Route::post('/user-role', 'store')->name('userRole.store');
        Route::patch('/user-role/update/{id}', 'update')->name('userRole.update');
        Route::delete('/user-role/destroy/{id}', 'destroy')->name('userRole.delete');
    });

    Route::controller(CourseCategoryController::class)->prefix('/course-category')->group(function() {
        Route::get('/', 'index')->name('courseCategory.index');
        Route::post('/store', 'store')->name('courseCategory.store');
        Route::patch('/update/{id}', 'update')->name('courseCategory.update');
        Route::delete('/delete/{id}', 'destroy')->name('courseCategory.destroy');
    });

    Route::controller(ModuleController::class)->prefix('/module')->group(function() {
        Route::get('/', 'index')->name('module.index');
        Route::post('/store', 'store')->name('module.store');
        Route::patch('/update/{id}', 'update')->name('module.update');
        Route::delete('/delete/{id}', 'destroy')->name('module.destroy');
    });

    Route::controller(MaterialController::class)->prefix('/material')->group(function() {
        Route::get('/', 'index')->name('material.index');
        Route::post('/store', 'store')->name('material.store');
        Route::patch('/update/{id}', 'update')->name('material.update');
        Route::delete('/delete/{id}', 'destroy')->name('material.destroy');
    });

    Route::controller(MaterialTypeController::class)->prefix('/material-type')->group(function() {
        Route::get('/', 'index')->name('materialType.index');
        Route::post('/store', 'store')->name('materialType.store');
        Route::patch('/update/{id}', 'update')->name('materialType.update');
        Route::delete('/delete/{id}', 'destroy')->name('materialType.destroy');
    });

    Route::controller(ForumController::class)->prefix('/forum')->group(function() {
        Route::get('/', 'index')->name('forum.index');
        Route::post('/store', 'store')->name('forum.store');
        Route::patch('/update/{id}', 'update')->name('forum.update');
        Route::delete('/delete/{id}', 'destroy')->name('forum.delete');
    });

    Route::controller(TargetController::class)->prefix('/target')->group(function() {
        Route::get('/', 'index')->name('target.index');

        Route::post('/store', 'store')->name('target.store');
        Route::patch('/update/{id}', 'update')->name('target.update');
        Route::delete('/delete/{id}', 'destroy')->name('target.delete');
    });

    Route::controller(TopicController::class)->prefix('/topic')->group(function() {
        Route::get('/', 'index')->name('topic.index');
        Route::post('/store', 'store')->name('topic.store');
        Route::patch('/update/{id}', 'update')->name('topic.update');
        Route::delete('/delete/{id}', 'destroy')->name('topic.delete');
    });

    Route::controller(UserController::class)->prefix('/users')->group(function() {
        Route::get('/menu', 'menu')->name('users.menu');
        Route::get('/{id}', 'index')->name('users.index');
        Route::post('/store', 'store')->name('users.store');
        Route::patch('/update/{id}', 'update')->name('users.update');
        Route::delete('/delete/{id}', 'destroy')->name('users.delete');
    });

    Route::controller(DifficultyLevelController::class)->prefix('/level')->group(function() {
        Route::get('/', 'index')->name('level.index');
        Route::post('/store', 'store')->name('level.store');
        Route::patch('/update/{id}', 'update')->name('level.update');
        Route::delete('/delete/{id}', 'destroy')->name('level.destroy');
    });

    Route::controller(ConfigurationController::class)->prefix('/config')->group(function() {
        Route::get('/', 'index')->name('config.index');
        Route::post('/store', 'store')->name('config.store');
        Route::patch('/update/{id}', 'update')->name('config.update');
        Route::delete('/delete/{id}', 'destroy')->name('config.destroy');
    });

    Route::controller(CourseController::class)->prefix('/course')->group(function() {
        Route::get('/', 'index')->name('course.index');
        Route::post('/store', 'store')->name('course.store');
        Route::patch('/update/{id}', 'update')->name('course.update');
        Route::delete('/delete/{id}', 'destroy')->name('course.destroy');
    });

    Route::controller(QuizTypeController::class)->prefix('/quiz-type')->group(function() {
        Route::get('/', 'index')->name('quizType.index');
        Route::post('/store', 'store')->name('quizType.store');
        Route::patch('/update/{id}', 'update')->name('quizType.update');
        Route::delete('/delete/{id}', 'destroy')->name('quizType.destroy');
    });

    Route::controller(QuizController::class)->prefix('/quiz')->group(function() {
        Route::get('/', 'index')->name('quiz.index');
        Route::post('/store', 'store')->name('quiz.store');
        Route::patch('/update/{id}', 'update')->name('quiz.update');
        Route::delete('/delete/{id}', 'destroy')->name('quiz.destroy');
        Route::get('/question/{id}', 'question')->name('quizQuestion.index');
        Route::post('/question/store', 'questionStore')->name('quizQuestion.store');
        Route::patch('/question/update/{id}', 'questionUpdate')->name('quizQuestion.update');
        Route::delete('/question/delete/{id}', 'questionDestroy')->name('quizQuestion.destroy');

        Route::post('/question/content/store', 'questionContentStore')->name('quizQuestionContent.store');
        Route::patch('/question/content/update/{id}', 'questionContentUpdate')->name('quizQuestionContent.update');
        Route::delete('/question/content/delete/{id}', 'questionContentDestroy')->name('quizQuestionContent.destroy');

        Route::post('/question/key/store', 'questionContentStore')->name('keyQuestion.store');
        Route::patch('/question/key/update/{id}', 'questionContentUpdate')->name('keyQuestion.update');
        Route::delete('/question/key/delete/{id}', 'questionContentDestroy')->name('keyQuestion.destroy');

        Route::post('/question/options/store', 'quizOptionsStore')->name('quizOptions.store');
        Route::patch('/question/options/update/{id}', 'quizOptionsUpdate')->name('quizOptions.update');
        Route::delete('/question/options/delete/{id}', 'quizOptionsDestroy')->name('quizOptions.destroy');

        Route::post('/question/answer/store', 'storeAnswerKey')->name('quiz.answerKey.store');
        Route::patch('/question/answer/update/{id}', 'quizAnswerUpdate')->name('quiz.answerKey.update');
        Route::delete('/question/answer/delete/{id}', 'quizAnswerDestroy')->name('quiz.answerKey.destroy');
    });

    Route::controller(ActivityLogController::class)->prefix('/activity-log')->group(function() {
        Route::get('/', 'index')->name('activityLog.index');
    });

    Route::controller(PaymentController::class)->prefix('/payment')->group(function() {
        Route::get('/', 'index')->name('payment.index');
    });

    Route::controller(AssessmentController::class)->prefix('/assessment')->group(function() {
        Route::get('/', 'index')->name('assessment.index');
    });
});

Route::get('/sso/login', [SSOController::class, 'showLoginForm'])->name('sso.login');
Route::post('/sso/login', [SSOController::class, 'login'])->name('sso.log');
