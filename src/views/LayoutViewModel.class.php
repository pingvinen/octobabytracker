<?php

class LayoutViewModel extends BaseViewModel
{
	private $title;

	public function setTitle($x)
	{
		$this->title = $x;
	}

	public function getTitle()
	{
		return $this->title;
	}
}
