<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Jobs\CallDollarValue;
use Carbon\Carbon;

class PaymentCtrl extends Controller
{

    public function __construct(){

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = $request->input('user_id', NULL);
        $payment = new Payment;

        if ($userId != NULL && Client::find($userId) != NULL){
            $payment->where('user_id', $payment);
        }

        return $payment->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->input('user_id', NULL);
        if (Client::find($userId) == NULL){
            response([ 
                'errors' => 'Client not found'
            ], 500);
        }


        $payment = new Payment;
        $payment->uuid = Str::uuid();
        $payment->payment_date = null;
        $payment->expires_at = '';
        $payment->status = 'pending';
        $payment->user_id = $userId;

        // Aca Hacemos el jobs

        $payment->float("clp_usd");
        $payment->save();

        return $payment;


        // Event para enviar correo
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ['test' => ];


        /*return ['test' => $moneySerieList->first(function ($moneyDay, $key) {
            return $moneyDay->fecha;
        })*/

        //array_map(function($moneyPerDayList), )
        //return var_dump($moneyPerDay->serie);


        $job = new CallDollarValue('dolar');
        dispatch($job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
