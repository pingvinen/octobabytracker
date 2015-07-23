<?php

/**
 * @route GET /
 */
class IndexController
{
	/**
	 * @var IndexViewModel
	 */
	private $model;

	public function __construct(IndexViewModel $model)
	{
		$this->model = $model;
	}

	public function execute(IWebRequest $request, IWebResponse $response)
	{
		$this->model->setTitle('Track it baby!');
		return $this->model;
	}
}
