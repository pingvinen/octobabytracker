<?php

/**
 * @ValueClass
 */
class Timing
{
	private $id;
	/**
	 * @var DateTime
	 */
	private $startedAt;
	private $feedingId;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getStartedAt()
	{
		return $this->startedAt;
	}

	/**
	 * @param $startedAt DateTime|null
	 */
	public function setStartedAt($startedAt)
	{
		$this->startedAt = $startedAt;
	}

	public function getFeedingId()
	{
		return $this->feedingId;
	}

	public function setFeedingId($feedingId)
	{
		$this->feedingId = $feedingId;
	}

	public function hasId()
	{
		return !is_null($this->id);
	}

	public function isRunning()
	{
		return !is_null($this->startedAt);
	}
}
