<?php

/**
 * @route POST /bottle
 */
class BottlePostController
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
		//DebugLog::separator(); DebugLog::log($request->postAll());

		$feeding = $this->feedingRepository->getInProgressOrNew();

		$type = $request->post('type', null);

		if (is_null($type))
		{
			throw new Exception('Missing type');
		}

		$amount = $request->post('amount', 0);

		if ($amount > 0)
		{
			switch (strtolower($type))
			{
				case 'milk':
					$type = Bottle::TYPE_MILK;
					break;

				case 'formula':
					$type = Bottle::TYPE_FORMULA;
					break;

				default:
					throw new Exception('Unknown type '.$type);
			}

			$feeding->setBottle(new Bottle($type, $amount));
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
