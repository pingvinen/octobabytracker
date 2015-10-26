<?php

class TimingAjaxViewModel extends AjaxViewModel
{
	/**
	 * @var DateHelper
	 * @jsonIgnore
	 */
	private $dateHelper;

	/**
	 * @var Feeding
	 * @jsonIgnore
	 */
	private $feeding;

	public function __construct(DateHelper $dateHelper)
	{
		$this->dateHelper = $dateHelper;
	}

	/**
	 * @var bool
	 */
	private $isRunning = false;

	/**
	 * @var int
	 */
	private $totalSeconds = 0;

	public function populateFromTiming(Timing $timing)
	{
		$this->isRunning = $timing->isRunning();

		$this->totalSeconds = $this->feeding->getBreastInSeconds();

		if ($timing->isRunning())
		{
			$runningTime = bcsub(
				  $this->dateHelper->now()->getTimestamp()
				, $timing->getStartedAt()->getTimestamp()
			);

			$this->totalSeconds = bcadd($this->totalSeconds, $runningTime);
		}
	}

	public function setFeeding(Feeding $feeding)
	{
		$this->feeding = $feeding;
	}
}
