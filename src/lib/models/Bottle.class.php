<?php

/**
 * @ValueClass
 */
class Bottle
{
	const TYPE_MILK = 'M';
	const TYPE_FORMULA = 'F';

	private $type;
	private $amount;

	public function __construct($type, $amount)
	{
		$this->type = $type;
		$this->amount = $amount;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function encode()
	{
		return $this->type.$this->amount;
	}

	public function decode($encoded)
	{
		$this->type = $encoded[0];
		$this->amount = substr($encoded, 1);
	}
}
