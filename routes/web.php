<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
# Route pour retourner l'index
Route::get('/',function() {
    return redirect('/auth/login');
});


Route::get('/auth/login',[UserController::class, 'login_form'])->name('login-form');
Route::get('/auth/showlist',[UserController::class, 'showList'])->name('showlist');
Route::post('/auth/login',[UserController::class, 'login'])->name('login');
Route::get('/auth/logout',[UserController::class, 'logout'])->middleware('isLoggedIn');


# Route pour la création d'un admin
Route::get('/auth/create-admin',[UserController::class, 'create'])->name('create-admin');
Route::post('/auth/create-admin',[UserController::class, 'store'])->name('store-admin');

# Gestion de l'utilisateur de niveau 2

Route::get('/dashbord',[UserController::class, 'index'])->name('auth.index');
Route::get('/user/showlist',[UserController::class, 'showList'])->name('showlist');
Route::post('/user/update',[UserController::class, 'updat'])->name('user.updat')->middleware('isLoggedIn');
Route::get('/user/delete/{id}',[UserController::class, 'destroy'])->name('user.delete')->middleware('isLoggedIn');
Route::get('/user/detail/{id}',[UserController::class, 'detail'])->middleware('isLoggedIn');
Route::get('/user/profil',[UserController::class, 'profil'])->middleware('isLoggedIn');
Route::get('/user/edit-profil',[UserController::class, 'editProfile'])->middleware('isLoggedIn');
Route::post('/user/profil/store-edition',[UserController::class, 'storeEditProfile'])->middleware('isLoggedIn');
Route::get('/user/change-password',[UserController::class, 'changePasswordForm'])->middleware('isLoggedIn');
Route::post('/user/change-password',[UserController::class, 'storeChangePasswordForm'])->middleware('isLoggedIn');
Route::post('/auth/change-first-user',[UserController::class, 'storeFirstChangePasswordForm']);
Route::get('/remember/{id}',[UserController::class, 'rememberLater']);
Route::get('/auth/forgotpassword',[UserController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('/auth/forgotpassword',[UserController::class, 'forgotPasswordCheckIdentifier'])->name('check');
Route::post('/auth/restore',[UserController::class, 'restore'])->name('reset');
Route::post('/auth/restore/change',[UserController::class, 'restoreChange'])->name('reset-change');
Route::post('/auth/check-code',[UserController::class, 'checkCode'])->name('check-code');
Route::get('/auth/same',[UserController::class, 'samePassword'])->name('same');
Route::get('/auth/resend',[UserController::class, 'resend'])->name('resend');

Route::get('/search',[UserController::class,'search'])->name('resend')->middleware('isLoggedIn');



# Gestion des utilisateur des niveau 2



Route::resource('user',UserController::class)->names([
    'create' => 'user.create',
    'edit'   => 'user.edit',
])->middleware('isLoggedIn');










