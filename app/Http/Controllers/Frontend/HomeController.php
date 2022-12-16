<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;

/**
 * Class HomeController.
 */

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return redirect(Auth::check() ? 'admin/dashboard' : 'login');
        //return view('frontend.index');
    }

    public function referralBy(Request $request)
    {
        return redirect()->away($request->device_platform == 'android' ? 'https://play.google.com/store/games' : 'https://www.apple.com/in/store');
    }
}
