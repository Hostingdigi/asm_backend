<?php

namespace App\Services;

use Mail;
use App\Mail\OrderMail;

class AppMailService
{
    public function sendMail($mailType, $mailData, $mailObject)
    {
        try {

            switch ($mailType) {
                case 'orderMail':
                    Mail::to($mailData['toAddress'])->later(now()->addSeconds(120), new OrderMail($mailObject));
                    break;

                case 'registerMail':
                    # code...
                    break;

                default:
                    # code...
                    break;
            }

            // Mail::to($request->email)->later(now()->addSeconds(10), new RegisterationMail($userData));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
