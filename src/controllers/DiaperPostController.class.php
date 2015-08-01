<?php

/**
 * @route POST /diaper
 */
class DiaperPostController
{
	/**
	 * @var InputAjaxViewModel
	 */
	private $model;
	/**
	 * @var FeedingRepository
	 */
	private $feedingRepository;

	public function __construct(InputAjaxViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		DebugLog::log($request->postAll());

		$feeding = $this->feedingRepository->getInProgressOrNew();

		$feeding->setPee($request->post('pee', $feeding->getPee()));
		$feeding->setPoo($request->post('poo', $feeding->getPoo()));

		if ($request->post('docommit', false))
		{
			$feeding->setStatus(Feeding::STATUS_Finalized);
			$this->model->setStatus($feeding->getStatus());
		}

		$this->feedingRepository->save($feeding);

		return $this->model;
	}
}
