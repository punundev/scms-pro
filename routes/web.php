<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\App\InvoiceCheckController;

Route::get('/home', fn() => view('app.home'))->name('app.home');
Route::get('/about-us', fn() => view('app.about'))->name('app.about');
Route::get('/contact', fn() => view('app.contact'))->name('app.contact');
Route::get('/what-we-do', fn() => view('app.whatwedo'))->name('app.whatwedo');
Route::get('/donation', fn() => view('app.donation'))->name('app.donation');
Route::get('/', fn() => redirect('/home'));



Route::middleware('guest')->group(function () {
  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
  Route::post('login', [AuthenticatedSessionController::class, 'store']);
});



Route::get('/lang/{locale}', function ($locale) {
  if (! in_array($locale, ['en', 'km',]))
    abort(400);

  app()->setLocale($locale);
  session()->put('locale', $locale);
  return back();
})->name('lang.switch');


Route::get('/invoice-check/{transactionId}', [InvoiceCheckController::class, 'show'])->name('invoice.check');



// include admin routes
require __DIR__ . '/admin.php';
