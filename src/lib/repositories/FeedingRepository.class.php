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
	/**
	 * @var UuidHelper
	 */
	private $uuidHelper;
	/**
	 * @var DateHelper
	 */
	private $dateHelper;

	public function __construct(
		  BabyTrackerDatabaseFactory $dbFactory
		, UuidHelper $uuidHelper
		, DateHelper $dateHelper
	)
	{
		$this->dbFactory = $dbFactory;
		$this->uuidHelper = $uuidHelper;
		$this->dateHelper = $dateHelper;
	}

	/**
	 * @var FeedingList
	 */
	public function getAll()
	{
		$list = new FeedingList();

		$rows = $this->dbFactory->getConnection()->getAll(
			  "select * from feedings where `status`=:status order by `date_time`"
			, array(':status'=>Feeding::STATUS_Finalized)
		);

		foreach ($rows as $row)
		{
			$list->add($this->populate($row));
		}

		return $list;
	}

	/**
	 * @return Feeding
	 */
	public function getInProgress()
	{
		$row = $this->dbFactory->getConnection()->getSingle(
			  "select * from feedings where `status`=:status"
			, array(':status'=>Feeding::STATUS_InProgress)
		);

		if (!is_null($row))
		{
			return $this->populate($row);
		}

		return new NullFeeding();
	}

	/**
	 * @return Feeding
	 */
	public function getInProgressOrNew()
	{
		$feeding = $this->getInProgress();

		if ($feeding instanceof NullFeeding)
		{
			$feeding = new Feeding();
			$feeding->setDateTime($this->dateHelper->now());
			$feeding->setStatus(Feeding::STATUS_InProgress);
		}

		return $feeding;
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
		$x->setStatus($row['status']);

		if (!empty($row['bottle']))
		{
			$bottle = new Bottle(Bottle::TYPE_MILK, 0);
			$bottle->decode($row['bottle']);
			$x->setBottle($bottle);
		}

		return $x;
	}

	public function save(Feeding $feeding)
	{
		if ($feeding instanceof NullFeeding)
		{
			throw new Exception('You cannot save NullFeeding');
		}

		if ($feeding->hasId())
		{
			$this->update($feeding);
		}
		else
		{
			$this->insert($feeding);
		}
	}

	protected function update(Feeding $feeding)
	{
		$this->dbFactory->getConnection()->update(
			"update feedings set
				  `date_time`=:date_time
				, `status`=:status
				, `breast_left`=:breast_left
				, `breast_right`=:breast_right
				, `milking`=:milking
				, `pee`=:pee
				, `poo`=:poo
				, `bottle`=:bottle
			  where
			  	`id`=:id
			", array(
				  'id' => $feeding->getId()
				, 'date_time' => $feeding->getDateTime()->format('Y-m-d H:i:s')
				, 'status' => $feeding->getStatus()
				, 'breast_left' => $feeding->getBreastLeft()
				, 'breast_right' => $feeding->getBreastRight()
				, 'milking' => $feeding->getMilking()
				, 'pee' => $feeding->getPee()
				, 'poo' => $feeding->getPoo()
				, 'bottle' => $feeding->hasBottle() ? $feeding->getBottle()->encode() : null
			)
		);
	}

	protected function insert(Feeding $feeding)
	{
		$feeding->setId($this->uuidHelper->get());

		$this->dbFactory->getConnection()->update(
			"insert into feedings set
				  `id`=:id
				, `date_time`=:date_time
				, `status`=:status
				, `breast_left`=:breast_left
				, `breast_right`=:breast_right
				, `milking`=:milking
				, `pee`=:pee
				, `poo`=:poo
				, `bottle`=:bottle
			", array(
				  'id' => $feeding->getId()
				, 'date_time' => $feeding->getDateTime()->format('Y-m-d H:i:s')
				, 'status' => $feeding->getStatus()
				, 'breast_left' => $feeding->getBreastLeft()
				, 'breast_right' => $feeding->getBreastRight()
				, 'milking' => $feeding->getMilking()
				, 'pee' => $feeding->getPee()
				, 'poo' => $feeding->getPoo()
				, 'bottle' => $feeding->hasBottle() ? $feeding->getBottle()->encode() : null
			)
		);
	}
}
