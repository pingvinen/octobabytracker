<?php

/**
 * @route GET /log
 */
class LogController
{
	/**
	 * @var LogViewModel
	 */
	private $model;
	/**
	 * @var FeedingRepository
	 */
	private $feedingRepository;

	public function __construct(LogViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$this->model->setTitle('Track it baby!');

		$this->model->setFeedings($this->feedingRepository->getAll());


		return $this->model;
	}
}
