<?php

class IndexViewModel extends BaseViewModel
{
	public function __construct(LayoutViewModel $layoutViewModel)
	{
		$this->layoutModel = $layoutViewModel;
	}

	public function setTitle($title)
	{
		$this->layoutModel->setTitle($title);
	}
}
