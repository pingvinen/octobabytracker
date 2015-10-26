<?php

abstract class InputPostControllerBase
{
	/**
	 * @var InputAjaxViewModel
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

	public function __construct(
		  InputAjaxViewModel $model
		, FeedingRepository $feedingRepository
		, TimingRepository $timingRepository
	)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
		$this->timingRepository = $timingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$feeding = $this->feedingRepository->getInProgressOrNew();

		$this->executeInner($request, $response, $feeding);

		if ($request->post('docommit', false))
		{
			$feeding->setStatus(Feeding::STATUS_Finalized);
			$this->model->setStatus($feeding->getStatus());

			$this->timingRepository->deleteForFeeding($feeding->getId());
		}

		$this->feedingRepository->save($feeding);

		return $this->model;
	}

	protected abstract function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding);
}
