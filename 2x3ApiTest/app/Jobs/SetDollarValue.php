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
            $paymentDate = $this->payment->payment_date;
            $currency = Currency::where('date', $paymentDate)
                ->first();

            // Set the currency if not exist in the database
            if ($currency === NULL){
                $dolarObject = getDolarValueByDate($paymentDate);      

                if ($dolarObject !== NULL){
                    $newCurrency = new Currency;
                    $newCurrency->value = $dolarObject['value'];
                    $newCurrency->date = $dolarObject['date'];    
                    $newCurrency->save();

                    $this->payment->clp_usd = $dolarObject['value'];
                    $this->payment->save();

                    Log::info("Money value is saved");
                } else {
                    Log::error('Money value is undefined');
                }

            } else {
                $this->payment->clp_usd = $currency->value;
                $this->payment->save();

                Log::info("Money value is not saved");
            }
        } catch (Exception $e) {
            
        }

        

    }
}
