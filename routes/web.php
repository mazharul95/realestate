<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('auth.login');
//});

// User Frontend All Route
Route::get('/', [UserController::class, 'index']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [UserController::class,
        'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class,
        'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class,
        'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class,
        'UserChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class,
        'UserPasswordUpdate'])->name('user.password.update');



});   //End User Frontend all Route

require __DIR__.'/auth.php';

//Start Admin Group middleware
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,
        'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout',[AdminController::class,
        'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile',[AdminController::class,
        'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class,
        'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class,
        'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class,
        'AdminUpdatePassword'])->name('admin.update.password');
});  //End Admin Group middleware


    //Start Agent Group middleware
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard',[AgentController::class,
        'AgentDashboard'])->name('agent.dashboard');

});  //End Agent Group middleware

Route::get('/admin/login',[AdminController::class,
    'AdminLogin'])->name('admin.login');


