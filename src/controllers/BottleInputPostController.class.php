<?php

/**
 * @route POST /bottle
 */
class BottleInputPostController extends InputPostControllerBase
{
	protected function executeInner(IWebRequest $request, IWebResponse $response, Feeding $feeding)
	{
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
	}
}
