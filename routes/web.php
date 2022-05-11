<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailListController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailGroupsReceiversController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/loginPost', [UserController::class, 'loginPost'])->name('login.post');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgot-password', [UserController::class, 'forgotPasswordPost'])->name('forgotPassword.post');

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name("index");
    Route::get('/profile', [UserController::class, 'profile'])->name("profile");
    Route::post('/profile', [UserController::class, 'profilePost'])->name("profile.post");
    Route::post('/password', [UserController::class, 'profilePasswordPost'])->name("profile.password.post");


    Route::prefix('user-management')->name('userManagement.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index']);

        Route::post('/add', [UserManagementController::class, 'insert'])->name("add.post");

        Route::post('/update/{id}', [UserManagementController::class, 'updateView'])->name("update");
        Route::post('/update/{id}', [UserManagementController::class, 'update'])->name("update.post");
        Route::get('/delete/{id}', [UserManagementController::class, 'delete'])->name("delete");
    });

    Route::prefix('user-credits')->name('userCredits.')->group(function () {
        Route::get('/{user}', [UserManagementController::class, 'index']);

        Route::post('/{user}/add', [UserManagementController::class, 'insert'])->name("add.post");

        Route::get('/{user}/delete/{id}', [UserManagementController::class, 'delete'])->name("delete");
    });



    Route::prefix('sms')->name('sms.')->group(function () {
        Route::get('/', [SmsController::class, 'home'])->name("home");
        Route::get('/send', [SmsController::class, 'sendHome'])->name("send");
        Route::post('/send', [SmsController::class, 'send'])->name("send.post");
        Route::post('/credit-validate', [SmsController::class, 'creditValidatePost'])->name("send.creditValidate");
        Route::get('/validate', [SmsController::class, 'validateHome'])->name("validate");
    });


    Route::prefix('email')->name('email.')->group(function () {
        Route::get('/', [EmailController::class, 'home'])->name("home");
        Route::get('/send', [EmailController::class, 'sendHome'])->name("send");
        Route::post('/send', [EmailController::class, 'send'])->name("send.post");
        Route::post('/credit-validate', [EmailController::class, 'creditValidatePost'])->name("send.creditValidate");
        Route::get('/validete', [EmailController::class, 'validateHome'])->name("validate");


        Route::prefix('templates')->name('templates.')->group(function () {
            Route::get('/', [EmailTemplateController::class, 'index']);
            Route::post('/', [EmailTemplateController::class, 'indexData'])->name("data");

            Route::get('/add', [EmailTemplateController::class, 'insertView'])->name("add");
            Route::post('/add', [EmailTemplateController::class, 'insert'])->name("add.post");

            Route::get('/view/{id}', [EmailTemplateController::class, 'view'])->name("view");
            Route::get('/update/{id}', [EmailTemplateController::class, 'updateView'])->name("update");
            Route::post('/update/{id}', [EmailTemplateController::class, 'update'])->name("update.post");
            Route::get('/delete/{id}', [EmailTemplateController::class, 'delete'])->name("delete");
        });

        Route::prefix('lists')->name('lists.')->group(function () {
            Route::get('/', [EmailListController::class, 'index']);
            Route::post('/', [EmailListController::class, 'indexData'])->name("data");

            Route::get('/add', [EmailListController::class, 'insertView'])->name("add");
            Route::post('/add', [EmailListController::class, 'insert'])->name("add.post");

            Route::get('/update/{id}', [EmailListController::class, 'updateView'])->name("update");
            Route::post('/update/{id}', [EmailListController::class, 'update'])->name("update.post");
            Route::get('/delete/{id}', [EmailListController::class, 'delete'])->name("delete");

            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/{group}', [MailGroupsReceiversController::class, 'index']);
                Route::post('/{group}', [MailGroupsReceiversController::class, 'indexData'])->name("data");

                Route::get('/{group}/add', [MailGroupsReceiversController::class, 'insertView'])->name("add");
                Route::post('/{group}/add', [MailGroupsReceiversController::class, 'insert'])->name("add.post");
                Route::post('/excel/{group}/add', [MailGroupsReceiversController::class, 'excel'])->name("excel.add.post");

                Route::get('/{group}/update/{id}', [MailGroupsReceiversController::class, 'updateView'])->name("update");
                Route::post('/{group}/update/{id}', [MailGroupsReceiversController::class, 'update'])->name("update.post");
                Route::get('/{group}/delete/{id}', [MailGroupsReceiversController::class, 'delete'])->name("delete");
            });
        });
    });

    Route::prefix('account')->name('lists.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name("index");
    });

});
