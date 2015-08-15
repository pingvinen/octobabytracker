<?php

/**
 * @route POST /breast
 */
class BreastPostController
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
		//DebugLog::log($request->postAll());

		$feeding = $this->feedingRepository->getInProgressOrNew();

		$whichBoob = $request->post('whichBoob', null);

		if (is_null($whichBoob))
		{
			throw new Exception('Missing whichBoob');
		}

		$totalMinutes = $request->post('totalMinutes', 0);

		if ($totalMinutes > 0)
		{
			$whichBoob = strtolower($whichBoob);
			switch ($whichBoob)
			{
				case 'left':
					$feeding->setBreastLeft($totalMinutes, $feeding->getBreastLeft());
					break;

				case 'right':
					$feeding->setBreastRight($totalMinutes, $feeding->getBreastRight());
					break;

				default:
					throw new Exception('Unknown boob '.$whichBoob);
			}
		}

		if ($request->post('docommit', false))
		{
			$feeding->setStatus(Feeding::STATUS_Finalized);
			$this->model->setStatus($feeding->getStatus());
		}

		$this->feedingRepository->save($feeding);

		return $this->model;
	}
}
