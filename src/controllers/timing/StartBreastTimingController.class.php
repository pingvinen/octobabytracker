<?php

/**
 * @route POST /breast/timing/start
 */
class StartBreastTimingController extends BreastTimingControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding, Timing $timing)
	{
		if (!$timing->isRunning())
		{
			$boob = $request->post('whichBoob', 'n/a');
			switch ($boob)
			{
				case 'left':
					if (is_null($feeding->getBreastLeft()))
					{
						$feeding->setBreastLeft(0);
					}
					break;

				case 'right':
					if (is_null($feeding->getBreastRight()))
					{
						$feeding->setBreastRight(0);
					}
					break;

				default:
					throw new Exception('I only know left and right boob... what the hell is '.$boob);
			}

			$timing->setStartedAt($this->dateHelper->now());
		}
	}
}
