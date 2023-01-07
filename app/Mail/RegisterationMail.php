<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Domains\Auth\Models\User;
use App\Models\CommonDatas;

class RegisterationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var Order
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appStoreLinks = CommonDatas::select(['id', 'value_1 as android_store'])->where([['key', '=', 'app_store_link'], ['status', '=', '1']])->first();
        $androidStore = $appStoreLinks ? (!empty($appStoreLinks->android_store) ? $appStoreLinks->android_store : '#') : '#';
        $appleStore = $appStoreLinks ? (!empty($appStoreLinks->android_store) ? $appStoreLinks->android_store : '#') : '#';

        return $this->subject('Account Created!')->view('emails.register', compact('androidStore', 'appleStore'));
    }
}
