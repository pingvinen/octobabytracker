<?php

/**
 * @route POST /milking
 */
class MilkingInputPostController extends InputPostControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding)
	{
		$feeding->setMilking($request->post('amount', $feeding->getMilking()));
	}
}
