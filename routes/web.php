<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(AdminController::class)->group(function (){
    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/admin/edit/profile','editProfile')->name('edit.profile');
    Route::post('/admin/store/profile','storeProfile')->name('store.profile');
    Route::get('/admin/change/password','changePassword')->name('change.password');
    Route::post('/admin/update/password','updatePassword')->name('update.password');
});

Route::controller(HomeSliderController::class)->group(function (){
   Route::get('/home/slider','homeSlider')->name('home.slide');
   Route::post('/update/slider','updateSlider')->name('update.slider');
});


Route::controller(AboutController::class)->group(function (){
    Route::get('/about/page','aboutPage')->name('about.page');
    Route::get('/about/update/page','updateAboutPage')->name('update.about.page');
});

require __DIR__.'/auth.php';
