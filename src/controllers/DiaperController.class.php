<?php

/**
 * @route GET /diaper
 */
class DiaperController
{
	/**
	 * @var InputViewModel
	 */
	private $model;
	/**
	 * @var FeedingRepository
	 */
	private $feedingRepository;

	public function __construct(InputViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$this->model->setTemplateName('Diaper');
		$this->model->setFeeding($this->feedingRepository->getInProgress());

		return $this->model;
	}
}
