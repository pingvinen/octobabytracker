<?php

/**
 * @route GET /breast
 */
class BreastController
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
		$this->model->setTemplateName('Breast');
		$this->model->setFeeding($this->feedingRepository->getInProgress());

		return $this->model;
	}
}
