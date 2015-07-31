<?php

/**
 * @ValueClass
 */
class Bottle
{
	const TYPE_MILK = 1;
	const TYPE_FORMULA = 2;

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
}
