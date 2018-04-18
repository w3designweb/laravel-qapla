<?php
namespace W3design\Qapla;

use GuzzleHttp;

class Qapla
{
	/**
	 * Private API key to connect a Qapla channel
	 * @var string
	 */
	protected $privateApiKey;

	/**
	 * Public API key to connect a Qapla channel
	 * @var string
	 */
	protected $publicApiKey;

	/**
	 * Qapla constructor.
	 *
	 * @param $privateApiKey
	 * @param $publicApiKey
	 */
	public function __construct($privateApiKey, $publicApiKey)
	{
		$this->privateApiKey = $privateApiKey;
		$this->publicApiKey = $publicApiKey;
	}

	/**
	 * Return the status of a shipment using the tracking number.
	 * @param string $tracking_or_reference ['trackingNumber' or 'reference']
	 * @param $value
	 * @param string $lang
	 *
	 * @return mixed
	 */
	public function getTrack($tracking_or_reference = 'trackingNumber', $value, $lang = 'ita')
	{
		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'getTrack/', ['query' =>  [
			'apiKey' => $this->privateApiKey,
			$tracking_or_reference => $value,
			'lang' => $lang]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->getTrack->result == 'KO') return $result->getTrack->error;
		return $result->getTrack;
	}

	/**
	 * Allows one or more shipments to be loaded via a POST request in JSON format.
	 * @param $data
	 *
	 * @return mixed
	 */
	public function pushTrack($data)
	{
		$json ='{
		    "apiKey": "'.$this->privateApiKey.'",
		    "pushTrack": '.json_encode($data).'
		}';

		$client = new GuzzleHttp\Client();
		$res = $client->post(config('qapla.url').'pushTrack/', [
			'headers' => ['content-type' => 'application/json'],
			'body' => $json
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		return $result->pushTrack->track;
	}

	/**
	 * Return the list of shipments imported from Qapla, with a maximum limit of 100 shipments per call.
	 * @param null $date_or_days
	 *
	 * @return mixed
	 */
	public function getTracks($date_or_days = null)
	{
		$param_name = 'dateFrom';
		$date_or_days ?: $date_or_days = config('qapla.orders.default_fromDate');
		if(strtotime($date_or_days) === false) $param_name = 'days';

		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'getTracks/', ['query' =>  [
			'apiKey'    => $this->privateApiKey,
			$param_name => $date_or_days]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->getTracks->result == 'KO') return $result->getTracks->error;
		return $result->getTracks->tracks;
	}

	/**
	 * Allows you to delete a shipment.
	 * @param $trackingNumber
	 *
	 * @return bool
	 */
	public function deleteTrack($trackingNumber)
	{
		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'deleteTrack/', ['query' =>  [
			'apiKey'            => $this->privateApiKey,
			'trackingNumber'    => $trackingNumber]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->deleteTrack->result == 'KO') return $result->deleteTrack->error;
		return true;
	}

	/**
	 * Return the list of orders imported from Qapla, with a maximum limit of 100 orders per call.
	 * @param null $date_or_days
	 *
	 * @return mixed
	 */
	public function getOrders($date_or_days = null)
	{
		$param_name = 'dateFrom';
		$date_or_days ?: $date_or_days = config('qapla.orders.default_fromDate');
		if(strtotime($date_or_days) === false) $param_name = 'days';

		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'getOrders/', ['query' =>  [
			'apiKey'    => $this->privateApiKey,
			$param_name => $date_or_days]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->getOrders->result == 'KO') return $result->getOrders->error;
		return $result->getOrders->orders;
	}

	/**
	 * Allows you to load one or more orders via a POST request in JSON format.
	 * @param $data
	 *
	 * @return bool
	 */
	public function pushOrder($data)
	{
		$json ='{
		    "apiKey": "'.$this->privateApiKey.'",
		    "pushOrder": '.json_encode($data).'
		}';

		$client = new GuzzleHttp\Client();
		$res = $client->post(config('qapla.url').'pushOrder/', [
			'headers' => ['content-type' => 'application/json'],
			'body' => $json
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->pushOrder->result == 'KO') return $result->pushOrder->error;
		return true;
	}

	/**
	 * Return the amount of the remaining credits on your premium account
	 * @return mixed
	 */
	public function getCredits()
	{
		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'getCredits/', ['query' =>  [
			'apiKey' => $this->privateApiKey]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->getCredits->result == 'KO') return $result->getCredits->error;
		return $result->getCredits->credits;
	}

	/**
	 * Return the list of couriers either total, or for single country/region.
	 * @param null $country
	 *
	 * @return mixed
	 */
	public function getCouriers($country = null)
	{
		$client = new GuzzleHttp\Client();
		$res = $client->get(config('qapla.url').'getCouriers/', ['query' =>  [
			'apiKey'    => $this->privateApiKey,
			'country'   => $country ?: config('qapla.couriers.default_country')]
		]);
		$result = GuzzleHttp\json_decode($res->getBody());
		if($result->getCouriers->result == 'KO') return $result->getCouriers->error;
		return $result->getCouriers->courier;
	}
}