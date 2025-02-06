<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PacketController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\DifficultyLevelController;
use App\Http\Controllers\Api\ForumController;
use App\Http\Controllers\Api\ForYouController;
use App\Http\Controllers\Api\GameAnswerController;
use App\Http\Controllers\Api\GameClaimController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PairingClaimController;
use App\Http\Controllers\Api\PrivateMessageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\QuizAnswerController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuizEnrollController;
use App\Http\Controllers\Api\QuizGameScoreController;
use App\Http\Controllers\Api\QuizResultController;
use App\Http\Controllers\Api\QuizTypeController;
use App\Http\Controllers\Api\RandomWordController;
use App\Http\Controllers\Api\ScrambledWordController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ValueHomeController;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\LearningHistoryController;
use App\Http\Controllers\Api\LearningProfileController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PreferenceController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return [
        'success' => true,
        'data' => $request->user(),
    ];
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/forgot', 'forgot');
    Route::post('/update-age', 'updateAge');
    Route::post('/users/verify-otp-forgot', 'verifyOtpForgot');
    Route::post('/reset', 'reset');
    Route::post('/users/verify-otp', 'verifyOtpRegister');
    Route::post('/users/new-otp', 'newOtp');
    Route::get('/users/profile', 'profile');
    Route::post('/edit/profile', 'updateProfile');
    Route::post('/logout', 'logout');
    Route::post('check/password', 'checkPassword');
    Route::post('change/password', 'changePassword');
});

Route::get('/get-onboarding-target', [ValueHomeController::class, 'getTargetOnBoarding']);

Route::controller(AssessmentController::class)
    ->prefix('/assessment')
    ->group(function () {
        Route::post('/store/{status}', 'store')->name('assessment.api.store');
        Route::put('/update-intial/{id}', 'updateAssessmentInitial')->name('assessment.api.updateAssessmentInitial');
    });

Route::middleware('auth:api')->group(function () {
    Route::controller(PacketController::class)->group(function () {
        Route::get('/get-all-paket/full-test', 'getAllPacketFullTest');
        Route::patch('/update-timer/{idPacket}', 'updateStatusFullTest');
        // Route::get('/get-status/{idPacket}/{idStatus}', 'getStatusFullTest');
        Route::get('/get-status/{idPacket}', 'getStatusFullTest');
        // Route::post('/create-status/{idPacket}/{idUser}', 'createStatusFullTest');
        Route::get('/get-all-paket/mini-test', 'getAllPacketMiniTest');
        Route::get('/get-pakets/{idPacket}', 'getQuestionPacket');
    });
    Route::controller(AnswerController::class)->group(function () {
        Route::post('/submit-paket/{idPacket}', 'submitPacket');
        Route::get('/get-score/{idPacket}', 'getScoreSubmit');
        Route::patch('/retake-test/{idPacket}', 'retakeTest');
        Route::get('/answer/users/{idPacket}', 'answerUsers');
    });
    Route::controller(BookmarkController::class)->group(function () {
        Route::get('/get-all-bookmark', 'getAllBookmark');
        Route::get('/get-bookmark/{idBookmark}', 'getSpesificBookmark');
        Route::patch('/add-bookmark/{idSoal}', 'addBookmark');
        Route::patch('/update-bookmark/{idBookmark}', 'updateBookmark');
    });

    Route::controller(ValueHomeController::class)->group(function () {
        Route::get('/get-all/targets', 'getAllTargetValue');
        Route::patch('/add-and-patch-target', 'addTarget');
        Route::get('/get-score-toefl', 'getLevelUser');
    });

    Route::controller(PrivateMessageController::class)
        ->prefix('/private-messages')
        ->group(function () {
            Route::get('/', 'index')->name('private-message.api.index');
            Route::post('/send', 'sendMessage')->name('private-message.api.store');
            Route::post('/{messageId}/update', 'updateMessage')->name('private-message.api.update');
            Route::delete('/{messageId}/delete', 'deleteMessage')->name('private-message.api.delete');
        });

    // Route::controller(AssessmentController::class)
    //     ->prefix('/assessment')
    //     ->group(function () {
    //         Route::post('/store', 'store')->name('assessment.api.store');
    //     });

    Route::controller(LearningProfileController::class)
        ->prefix('/learning-profile')
        ->group(function () {
            Route::post('/store', 'store')->name('learningProfile.api.store');
        });

    Route::controller(LearningHistoryController::class)
        ->prefix('/learning-history')
        ->group(function () {
            Route::post('/store', 'store')->name('learningHistory.api.store');
        });

    Route::controller(PreferenceController::class)
        ->prefix('/preference')
        ->group(function () {
            Route::post('/store', 'store')->name('preference.api.store');
        });

    Route::controller(PaymentController::class)
        ->prefix('/payment')
        ->group(function () {
            Route::post('/store', 'store')->name('payment.api.store');
            Route::post('/update/status-completed/{id}', 'updateTransactionCompleted')->name('payment.api.updateTransactionCompleted');
            Route::post('/update/status-failed/{id}', 'updateTransactionFailed')->name('payment.api.updateTransactionFailed');
        });

    Route::controller(ActivityLogController::class)
        ->prefix('/activity-log')
        ->group(function () {
            Route::post('/store', 'store')->name('activityLog.api.store');
        });

    Route::controller(DifficultyLevelController::class)
        ->prefix('/level')
        ->group(function () {
            Route::get('/', 'index')->name('level.api.index');
        });

    Route::controller(ForumController::class)
        ->prefix('/forum')
        ->group(function () {
            Route::get('/', 'index')->name('forum.api.index');
        });

    Route::controller(TopicController::class)
        ->prefix('/topic')
        ->group(function () {
            Route::get('/', 'index')->name('topic.api.index');
            Route::get('/{id}', 'getByID')->name('topic.api.getByID');
            Route::post('/store', 'store')->name('topic.api.store');
            Route::patch('/update/{id}', 'update')->name('topic.api.update');
            Route::delete('/delete/{id}', 'delete')->name('topic.api.delete');
        });

    Route::controller(CommentController::class)
        ->prefix('/comment')
        ->group(function () {
            Route::get('/', 'index')->name('comment.api.index');
            Route::get('/c_id/{id}', 'getByCommentID')->name('comment.api.getByCommentID');
            Route::get('/p_id/{post_id}', 'getByPostID')->name('comment.api.getByPostID');
            Route::post('/store', 'store')->name('comment.api.store');
            Route::patch('/update/{id}', 'update')->name('comment.api.update');
            Route::delete('/delete/{id}', 'delete')->name('comment.api.delete');
        });

    Route::controller(PostController::class)
        ->prefix('/post')
        ->group(function () {
            Route::get('/', 'index')->name('post.api.index');
            Route::get('/{id}', 'getByID')->name('post.api.getByID');
            Route::post('/store', 'store')->name('post.api.store');
            Route::patch('/update/{id}', 'update')->name('post.api.update');
            Route::delete('/delete/{id}', 'delete')->name('post.api.delete');
        });

    Route::resource('/randomword', RandomWordController::class);
    Route::resource('/quizs', QuizController::class);
    Route::resource('/quiztypes', QuizTypeController::class);
    Route::resource('/games', GameController::class);
    Route::resource('/gameclaims', GameClaimController::class);
    Route::resource('/quizclaims', QuizEnrollController::class);
    Route::resource('/leaderboard', QuizGameScoreController::class);
    Route::resource('/gameanswer', GameAnswerController::class);
    Route::resource('/quizanswer', QuizAnswerController::class);
    Route::resource('/quizgameresult', QuizResultController::class);
    Route::resource('/randomword', RandomWordController::class);
    Route::resource('/scrambledword', ScrambledWordController::class);
    Route::resource('/pairingclaims', PairingClaimController::class);
    Route::resource('/foryou', ForYouController::class);
});

Route::post('/storequiz', [QuizController::class, 'store']);
