<?php

namespace App\Mail;

use App\Models\CommonDatas;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ccEmail = CommonDatas::select(['id', 'value_1 as emails'])->where([['key', '=', 'cc_emails'], ['value_1', '!=', ''], ['status', '=', '1']])->first();
        $ccEmails = $ccEmail ? explode(',', $ccEmail->emails) : null;

        $thisBuildObject = $this->subject('Order has been placed - #' . $this->order->order_no)->view('emails.order');
        if (!empty($ccEmails)) {
            $thisBuildObject = $thisBuildObject->bcc($ccEmails);
        }
        return $thisBuildObject;
    }
}
