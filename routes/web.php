<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiTestController;
use App\Http\Controllers\Auth\LoginController;

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

//トップ

Route::get('/', [HomeController::class, 'top'])->name('top');

//API連携

Route::get('/api',[ApiTestController::class, 'test']);

//一般ユーザログイン画面


//医療医関係者ログイン画面

Route::get('/doctorlogin', function () 
    {
        return view('auth.doctorlogin');
    })->name('doctorlogin');

//管理ユーザログイン画面

Route::get('/adminlogin', function () 
    {
        return view('auth.adminlogin');
    })->name('adminlogin');


//患者詳細画面

Route::get('/show/{id}', [HomeController::class, 'show'])->name('showGET');
Route::post('/show/{id}', [HomeController::class, 'show'])->name('show');

//薬追加画面

Route::get('/add', function () 
    {
        return view('medapp.add');
    })->name('add');

//追加画面内容確認

Route::get('/med-confirm', [HomeController::class, 'confirm'])->name('confirm');
Route::post('/med-confirm', [HomeController::class, 'addconfirm'])->name('addconfirm');


//データ送信

Route::post('/complete', [HomeController::class, 'send'])->name('send');


//編集画面

Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::post('/edit/{id}', [HomeController::class, 'edit'])->name('edit');

//編集画面後のリダイレクト処理
Route::get('/finishEdit', [HomeController::class, 'finishEditGET'])->name('finishEditGET');
Route::post('/finishEdit', [HomeController::class, 'finishEdit'])->name('finishEdit');

//アップデート
Route::get('/update/{id}', [HomeController::class, 'update'])->name('update');
Route::post('/update/{id}', [HomeController::class, 'update'])->name('update');

//削除
Route::get('/delete/{id}', [HomeController::class, 'delete'])->name('delete');
Route::post('/delete/{id}', [HomeController::class, 'deletePOST'])->name('deletePOST');

//患者追加

Route::get('/add_patient', [HomeController::class, 'addPatientGET'])->name('addPatientGET');
Route::post('/add_patient', [HomeController::class, 'addPatient'])->name('addPatient');


//患者削除

Route::get('/remove_patient/{id}', [HomeController::class, 'removePatientGET'])->name('removePatientGET');
Route::post('/remove_patient/{id}', [HomeController::class, 'removePatient'])->name('removePatient');

//管理ユーザ用のユーザ削除処理

Route::get('/deleteUser/{id}', [HomeController::class, 'deleteUserGET'])->name('deleteUserGET');
Route::post('/deleteUser/{id}', [HomeController::class, 'deleteUser'])->name('deleteUser');

//プロフィール画像のアップロード

Route::get('/pictureUpdate/{id}', [HomeController::class, 'pictureUpdateGET'])->name('pictureUpdateGET');
Route::post('/pictureUpdate/{id}', [HomeController::class, 'pictureUpdate'])->name('pictureUpdate');

//カレンダーに追加
Route::get('/calendar', function(){
    return view('medapp.calendar');
})->name('calendar');
Route::get('/get_events', [HomeController::class, 'getEvents']);



Route::get('/addevent', [HomeController::class, 'addeventGET'])->name('addeventGET');
Route::post('/addevent', [HomeController::class, 'addEvent'])->name('addEvent');


//退会する

Route::get('/deleteaccount', [HomeController::class, 'deleteaccountGET'])->name('deleteaccountGET');
Route::post('/deleteaccount', [HomeController::class, 'taikai'])->name('taikai');

//医療関係者が薬を患者の薬袋に追加する

Route::get('/padd', [HomeController::class, 'padd'])->name('padd');

Route::get('/pconfirm', [HomeController::class, 'pconfirmGET'])->name('pconfirmGET');
Route::post('/pconfirm', [HomeController::class, 'pconfirm'])->name('pconfirm');


Route::get('/p-med-confirm', [HomeController::class, 'confirm'])->name('confirm');
Route::post('/p-med-confirm', [HomeController::class, 'paddconfirm'])->name('paddconfirm');

Route::get('/p-med-send', [HomeController::class, 'psendGET'])->name('psendGET');
Route::post('/p-med-send', [HomeController::class, 'psend'])->name('psend');

Route::get('/forgot-password', function(){
    return view('auth.forgot-password');
})->name('forgotpass');
Route::post('/forgot-password', function(){
    return view('auth.forgot-password');
})->name('forgotpass');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'mydash'])->name('dashboard');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
