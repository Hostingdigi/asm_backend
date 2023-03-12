<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Mail\OrderMail;
use App\Models\Order;
use Tabuna\Breadcrumbs\Trail;

// use Mail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('test_mail', function () {

    // Mail::send('emails.test2', [], function ($m) {
    //     $m->to('bahadurajm@gmail.com', 'Lal')->subject('Test');
    // });

    // Mail::to('bahadurajm@gmail.com')->later(now()->addSeconds(2), new OrderMail(Order::find(54)));

    return (new OrderMail(Order::find(163)))->render();
    // return (new RegisterationMail(User::find(2)))->render();
    // return view('emails.order');

});

Route::get('referral-by', [HomeController::class, 'referralBy'])->name('referral-by');

Route::get('privacy-policy', [TermsController::class, 'privacy'])
    ->name('pages.privacy-policy')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Privacy & Policy'), route('frontend.pages.privacy-policy'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
