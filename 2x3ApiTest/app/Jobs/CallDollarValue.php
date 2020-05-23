<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Payment;
use \App\Models\Currency;

class CallDollarValue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    protected $currency;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Currency $currency, Payment $payment)
    {   
        $this->currency = $currency;
        $this->payment = $
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $currency = Currency::where('date', $payment->payment_date)->first();

        if ($currency === NULL){
            
            
        } else {
           Log::info("Money value is not saved");    
        }

        
    }
}
