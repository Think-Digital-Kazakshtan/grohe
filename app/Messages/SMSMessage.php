<?php
namespace App\Messages;

use Mobizon\MobizonApi;

class SMSMessage
{
	private $api;
	protected $lines = [];
	protected $from;
	protected $to;

	public function __construct($lines = [])
	{
		$this->api = new MobizonApi(env('MOBIZON_API_KEY'), env('MOBIZON_HOST'));
		$this->from = env('APP_NAME');
		$this->lines = $lines;
	}

	public function from($from)
	{
		$this->from = $from;
		return $this;
	}

	public function to($to)
	{
		$this->to = $to;
		return $this;
	}

	public function line($line = '')
	{
		$this->lines[] = $line;
		return $this;
	}

	public function send()
	{
		if (!$this->from || !$this->to || empty($this->lines)) {
			throw new \Exception('SMS not correct.');
		}
		return $this->api->call(
			'message',
			'sendSMSMessage',
			[
				'recipient' => ltrim($this->to, '+'),
				'text' => implode("\n", $this->lines),
				// 'from' => $this->from,
			]
		);
	}
}