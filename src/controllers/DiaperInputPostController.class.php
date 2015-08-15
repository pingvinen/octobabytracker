<?php

/**
 * @route POST /diaper
 */
class DiaperInputPostController extends InputPostControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding)
	{
		$feeding->setPee($request->post('pee', $feeding->getPee()));
		$feeding->setPoo($request->post('poo', $feeding->getPoo()));
	}
}
