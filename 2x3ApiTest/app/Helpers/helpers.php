<?php

use \Carbon\Carbon;

/**
 * 
 * Return is the two dates are the same date
 * 
 * @param date | timestamp
 * @param date | timestamp
 * 
 * @return bool
 */
function isSameDate($dateA, $dateB){
	$dateA = Carbon::parse($dateA);
	$dateB = Carbon::parse($dateB);

	return $dateA->toDateString() === $dateB->toDateString();
}


/**
 * Return a content object from HTTP Body Response via Guzzle
 * 
 * @return Object
 */
function getDolarBody(){
	$httpClient = new \GuzzleHttp\Client([
        'base_uri' => env('API_DOLLAR'),
    ]);

    $httpResponse = $httpClient->get('dolar');
    $moneyResponse = (object) json_decode($httpResponse->getBody());
    return $moneyResponse;
}


/**
 * Return an array than contains dates and values of pesos by dollar
 * 
 * @return array<date, string>
 */
function getDolarValueList(){
	$moneyResponse = getDolarBody();
	return collect($moneyResponse->serie);
}


/**
 * Return value of chilean pesos per one dollar and by Date
 * 
 * @param string
 * @return object<date, string> | NULL
 */
function getDolarValueByDate($date){
	$dolarList = getDolarValueList();
	$dolarObject = $dolarList->first(function ($moneyObject, $key) use ($date) 
	{
	    return isSameDate($moneyObject->fecha, $date);
	});

	return $dolarObject;
}




?>