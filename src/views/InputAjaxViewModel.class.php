<?php

class InputAjaxViewModel extends AjaxViewModel
{
	protected $hello = 'world';
	protected $status;

	public function setHello($hello)
	{
		$this->hello = $hello;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}
}
