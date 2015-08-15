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

	public function __construct(InputAjaxViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		//DebugLog::separator(); DebugLog::log($request->postAll());

		$feeding = $this->feedingRepository->getInProgressOrNew();

		$this->executeInner($request, $response, $feeding);

		if ($request->post('docommit', false))
		{
			$feeding->setStatus(Feeding::STATUS_Finalized);
			$this->model->setStatus($feeding->getStatus());
		}

		$this->feedingRepository->save($feeding);

		return $this->model;
	}

	protected abstract function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding);
}
