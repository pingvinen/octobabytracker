<?php

class LogViewModel extends BaseViewModel
{
	/**
	 * @var FeedingList
	 */
	private $feedings;

	public function __construct(LayoutViewModel $layoutViewModel)
	{
		$this->layoutModel = $layoutViewModel;
		$this->feedings = new FeedingList();
	}

	public function setTitle($title)
	{
		$this->layoutModel->setTitle($title);
	}

	public function getFeedings()
	{
		return $this->feedings;
	}

	public function setFeedings(FeedingList $list)
	{
		$this->feedings = $list;
	}
}
