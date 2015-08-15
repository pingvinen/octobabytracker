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
	/**
	 * @var StringHelper
	 */
	protected $stringHelper;

	public function __construct(InputViewModel $model, FeedingRepository $feedingRepository, StringHelper $stringHelper)
	{
		$this->model = $model;
		$this->feedingRepository = $feedingRepository;
		$this->stringHelper = $stringHelper;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$this->model->setTemplateName($this->getTemplateName());
		$this->model->setFeeding($this->feedingRepository->getInProgress());

		$feeding = $this->model->getFeeding();

		if ($feeding->hasBottle() && !$this->stringHelper->startsWith($request->path(), '/bottle'))
		{
			$response->redirect('/bottle');
		}
		else if ($feeding->hasMilking() && !$this->stringHelper->startsWith($request->path(), '/milking'))
		{
			$response->redirect('/milking');
		}
		else if ($feeding->hasBreastFeeding() && !$this->stringHelper->startsWith($request->path(), '/breast'))
		{
			$response->redirect('/breast');
		}
		else if ($feeding->hasDiaper() && !$this->stringHelper->startsWith($request->path(), '/diaper'))
		{
			$response->redirect('/diaper');
		}

		return $this->model;
	}

	protected abstract function getTemplateName();
}
