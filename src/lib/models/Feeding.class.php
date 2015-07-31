<?php

class Feeding
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var DateTime
	 */
	private $dateTime;

	/**
	 * Time on left breast in minutes
	 * @var int
	 */
	private $breastLeft;

	/**
	 * Time on right breast in minutes
	 * @var int
	 */
	private $breastRight;

	/**
	 * @var Bottle
	 */
	private $bottle;

	/**
	 * How much pee (on arbitrary scale) was in the diaper
	 * @see DiaperAmount
	 * @var int
	 */
	private $pee;

	/**
	 * How much poo (on arbitrary scale) was in the diaper
	 * @see DiaperAmount
	 * @var int
	 */
	private $poo;

	/**
	 * How much milk was milked in mL
	 * @var int
	 */
	private $milking;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getDateTime()
	{
		return $this->dateTime;
	}

	public function setDateTime(DateTime $dateTime)
	{
		$this->dateTime = $dateTime;
	}

	public function getBreastLeft()
	{
		return $this->breastLeft;
	}

	public function setBreastLeft($breastLeft)
	{
		$this->breastLeft = $breastLeft;
	}

	public function getBreastRight()
	{
		return $this->breastRight;
	}

	public function setBreastRight($breastRight)
	{
		$this->breastRight = $breastRight;
	}

	public function getBottle()
	{
		return $this->bottle;
	}

	public function setBottle(Bottle $bottle)
	{
		$this->bottle = $bottle;
	}

	public function getPee()
	{
		return $this->pee;
	}

	public function setPee($pee)
	{
		$this->pee = $pee;
	}

	public function getPoo()
	{
		return $this->poo;
	}

	public function setPoo($poo)
	{
		$this->poo = $poo;
	}

	public function getMilking()
	{
		return $this->milking;
	}

	public function setMilking($milking)
	{
		$this->milking = $milking;
	}

	public function hasBottle()
	{
		return !is_null($this->bottle);
	}
}
