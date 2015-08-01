<?php

class InputViewModel extends BaseViewModel
{
	/**
	 * @var Feeding
	 */
	private $feeding;

	public function __construct(LayoutViewModel $layoutViewModel)
	{
		$this->layoutModel = $layoutViewModel;
	}

	public function setTitle($title)
	{
		$this->layoutModel->setTitle($title);
	}

	public function getFeeding()
	{
		return $this->feeding;
	}

	public function setFeeding(Feeding $feeding)
	{
		$this->feeding = $feeding;
	}
}
