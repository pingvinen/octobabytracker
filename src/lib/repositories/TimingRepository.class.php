<?php

/**
 * @singleton
 */
class TimingRepository
{
	/**
	 * @var BabyTrackerDatabaseFactory
	 */
	private $dbFactory;
	/**
	 * @var UuidHelper
	 */
	private $uuidHelper;

	public function __construct(
		  BabyTrackerDatabaseFactory $dbFactory
		, UuidHelper $uuidHelper
	)
	{
		$this->dbFactory = $dbFactory;
		$this->uuidHelper = $uuidHelper;
	}

	/**
	 * @return Timing
	 */
	public function getRunningOrNewForFeeding($feedingId)
	{
		$all = $this->dbFactory->getConnection()->getAll(
			  "select * from `timings` where `feeding_id`=:feeding_id"
			, array(':feeding_id' => $feedingId)
		);

		switch (count($all))
		{
			case 0:
				$timing = new Timing();
				$timing->setFeedingId($feedingId);

				return $timing;

			case 1:
				return $this->populate($all[0]);

			default:
				throw new Exception("There is more than 1 timing for feeding $feedingId");
		}
	}

	public function deleteForFeeding($feedingId)
	{
		$this->dbFactory->getConnection()->update("
			  delete from `timings` where `feeding_id`=:feeding_id"
			, array(':feeding_id' => $feedingId)
		);
	}

	public function save(Timing $timing)
	{
		if ($timing->hasId())
		{
			$this->update($timing);
		}
		else
		{
			$this->insert($timing);
		}
	}

	private function update(Timing $timing)
	{
		$this->dbFactory->getConnection()->update(
			"update timings set
				  `feeding_id`=:feeding_id
				, `started_at`=:started_at
				where
					`id`=:id"
			, array(
				  ':id' => $timing->getId()
				, ':feeding_id' => $timing->getFeedingId()
				, ':started_at' => $timing->isRunning() ? $timing->getStartedAt()->format('Y-m-d H:i:s') : null
			)
		);
	}

	private function insert(Timing $timing)
	{
		$timing->setId($this->uuidHelper->get());

		$this->dbFactory->getConnection()->update(
			"insert into timings set
				  `id`=:id
				, `feeding_id`=:feeding_id
				, `started_at`=:started_at
				"
			, array(
				  ':id' => $timing->getId()
				, ':feeding_id' => $timing->getFeedingId()
				, ':started_at' => $timing->isRunning() ? $timing->getStartedAt()->format('Y-m-d H:i:s') : null
			)
		);
	}

	private function populate(array $row)
	{
		$x = new Timing();
		$x->setId($row['id']);
		$x->setStartedAt(empty($row['started_at']) ? null : new DateTime($row['started_at']));
		$x->setFeedingId($row['feeding_id']);

		return $x;
	}
}
