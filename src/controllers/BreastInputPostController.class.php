<?php

/**
 * @route POST /breast
 */
class BreastInputPostController extends InputPostControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding)
	{
		$whichBoob = $request->post('whichBoob', null);

		if (is_null($whichBoob))
		{
			throw new Exception('Missing whichBoob');
		}

		$totalMinutes = $request->post('totalMinutes', 0);

		$whichBoob = strtolower($whichBoob);
		switch ($whichBoob)
		{
			case 'left':
				$feeding->setBreastLeft($totalMinutes);
				break;

			case 'right':
				$feeding->setBreastRight($totalMinutes);
				break;

			default:
				throw new Exception('Unknown boob '.$whichBoob);
		}
	}
}
