<?php

/**
 * @route GET /
 */
class IndexController
{
	/**
	 * @var IndexViewModel
	 */
	private $model;
	/**
	 * @var FeedingRepository
	 */
	private $feedingRepository;

	public function __construct(IndexViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$feeding = $this->feedingRepository->getInProgress();

		if ($feeding->hasBottle())
		{
			$response->redirect('/bottle');
		}
		else if ($feeding->hasMilking())
		{
			$response->redirect('/milking');
		}
		else if ($feeding->hasBreastFeeding())
		{
			$response->redirect('/breast');
		}
		else if ($feeding->hasDiaper())
		{
			$response->redirect('/diaper');
		}

		return $this->model;
	}
}
