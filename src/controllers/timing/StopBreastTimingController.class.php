<?php

/**
 * @route POST /breast/timing/stop
 */
class StopBreastTimingController extends BreastTimingControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding, Timing $timing)
	{
		if ($timing->isRunning())
		{
			$now = $this->dateHelper->now();

			$diff = bcsub($now->getTimestamp(), $timing->getStartedAt()->getTimestamp());

			$feeding->addSecondsToBreastFeeding($diff);

			$timing->setStartedAt(null);
		}
	}
}
