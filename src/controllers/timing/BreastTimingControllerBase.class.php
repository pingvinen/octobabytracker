<?php

abstract class BreastTimingControllerBase
{
	/**
	 * @var TimingAjaxViewModel
	 */
	protected $model;
	/**
	 * @var FeedingRepository
	 */
	protected $feedingRepository;
	/**
	 * @var TimingRepository
	 */
	protected $timingRepository;
	/**
	 * @var DateHelper
	 */
	protected $dateHelper;

	public function __construct(
		  TimingAjaxViewModel $model
		, FeedingRepository $feedingRepository
		, TimingRepository $timingRepository
		, DateHelper $dateHelper
	)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
		$this->timingRepository = $timingRepository;
		$this->dateHelper = $dateHelper;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$feeding = $this->feedingRepository->getInProgressOrNew();
		$timing = $this->timingRepository->getRunningOrNewForFeeding($feeding->getId());

		$this->model->setFeeding($feeding);

		if (!$feeding->hasId())
		{
			// this set of controllers requires an
			// official feeding to exist
			$this->feedingRepository->save($feeding);
		}

		$this->executeInner($request, $response, $feeding, $timing);

		$this->feedingRepository->save($feeding);
		$this->timingRepository->save($timing);

		$this->model->populateFromTiming($timing);

		return $this->model;
	}

	protected abstract function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding, Timing $timing);
}
