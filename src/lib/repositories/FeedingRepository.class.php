<?php

/**
 * @singleton
 */
class FeedingRepository
{
	/**
	 * @var BabyTrackerDatabaseFactory
	 */
	private $dbFactory;

	public function __construct(BabyTrackerDatabaseFactory $dbFactory)
	{
		$this->dbFactory = $dbFactory;
	}

	/**
	 * @var FeedingList
	 */
	public function getAll()
	{
		$list = new FeedingList();

		$rows = $this->dbFactory->getConnection()->getAll("select * from feedings order by `date_time`");

		foreach ($rows as $row)
		{
			$list->add($this->populate($row));
		}

		return $list;
	}

	private function populate(array $row)
	{
		$x = new Feeding();
		$x->setId($row['id']);
		$x->setBreastLeft($row['breast_left']);
		$x->setBreastRight($row['breast_right']);
		$x->setMilking($row['milking']);
		$x->setPee($row['pee']);
		$x->setPoo($row['poo']);
		$x->setDateTime(new DateTime($row['date_time']));

		if (!empty($row['bottle']))
		{
			$type = $row['bottle'][0];
			$x->setBottle(new Bottle($type, substr($row['bottle'], 1)));
		}

		return $x;
	}
}
