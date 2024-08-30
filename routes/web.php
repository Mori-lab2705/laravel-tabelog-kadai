<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReservationController;


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

Route::get('/', [WebController::class, 'index'])->name('top');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
   
});


Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store'); 
Route::get('/users/{userId}/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/users/{userId}/reservations/edit',  [ReservationController::class, 'edit'])->name('reservations.edit');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');


Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('shops/{shop}/favorite', [ShopController::class, 'favorite'])->name('shops.favorite'); 

Route::resource('shops', ShopController::class)->middleware(['auth', 'verified']);
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/subscription', function () {
    return view('subscription', [
        'intent' => auth()->user()->createSetupIntent(),
        'isSubscribed' => auth()->user()->subscribed('default')
    ]);
})->middleware(['auth'])->name('subscription'); 

Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription(
        'default', 'price_1PoQmuGRKUFslzadkW2kZnES'
    )->create($request->paymentMethodId);

    return redirect('/home');

})->middleware(['auth'])->name('subscribe.post');

Route::post('/subscription/cancel', function (Request $request) {
    $request->user()->subscription('default')->cancelNow();
    return back();
})->middleware(['auth'])->name('stripe.cancel'); 


