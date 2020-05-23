<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Payment;
use \App\Models\Currency;
use Illuminate\Support\Facades\Log;

class SetDollarValue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $payment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * If the currency value is NULL it means than not was added to 
     * the database and this case should call the Dolar API
     * 
     * @return void
     */
    public function handle()
    {
        try {
            
        } catch (Exception $e) {
            
        }

        

    }
}
