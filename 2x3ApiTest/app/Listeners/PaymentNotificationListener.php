<?php

namespace App\Listeners;

use App\Events\PaymentNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\PaymentNotificationMail;

class PaymentNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentNotificationEvent  $event
     * @return void
     */
    public function handle(PaymentNotificationEvent $event)
    {
        \Mail::to($event->client->email)->send(
            new PaymentNotificationMail($event->client->email)
        );
    }
}
