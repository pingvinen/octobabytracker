<?php

abstract class InputControllerBase
{
	/**
	 * @var InputViewModel
	 */
	protected $model;
	/**
	 * @var FeedingRepository
	 */
	protected $feedingRepository;

	public function __construct(InputViewModel $model, FeedingRepository $feedingRepository)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$this->model->setTemplateName($this->getTemplateName());
		$this->model->setFeeding($this->feedingRepository->getInProgress());

		$feeding = $this->model->getFeeding();

		if ($feeding->hasBottle() && $request->path() !== '/bottle')
		{
			$response->redirect('/bottle');
		}
		else if ($feeding->hasMilking() && $request->path() !== '/milking')
		{
			$response->redirect('/milking');
		}
		else if ($feeding->hasBreastFeeding() && $request->path() !== '/breast')
		{
			$response->redirect('/breast');
		}
		else if ($feeding->hasDiaper() && $request->path() !== '/diaper')
		{
			$response->redirect('/diaper');
		}

		return $this->model;
	}

	protected abstract function getTemplateName();
}
