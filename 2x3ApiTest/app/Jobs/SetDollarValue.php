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
    protected $date;

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
        $currency = Currency::where('date', $this->payment->payment_date)
            ->first();

        // Set the currency if not exist in the database
        if ($currency === NULL){
            $dolarObject = getDolarValueByDate(
                $this->payment->payment_date
            );      

            if ($dolarObject !== NULL){
                $currency->value = $dolarObject->valor;
                $currency->date = $this->payment->payment_date;    

                $payment->clp_usd = $dolarObject->valor;
                $payment->save();

                Log::info("Money value is saved");
            } else {
                Log::error('Money value is undefined');
            }

        } else {
            $payment->clp_usd = $currency->value;
            $payment->save();

            Log::info("Money value is not saved");
        }

    }
}
