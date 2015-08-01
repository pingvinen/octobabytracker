<?php

class NullFeeding extends Feeding
{
	const ID = 'null_feeding';

	public function getId()
	{
		return self::ID;
	}

	public function hasBottle()
	{
		return false;
	}

	public function hasBreastFeeding()
	{
		return false;
	}

	public function hasMilking()
	{
		return false;
	}

	public function hasDiaper()
	{
		return false;
	}

	public function getPee()
	{
		return DiaperAmount::NONE;
	}

	public function getPoo()
	{
		return DiaperAmount::NONE;
	}
}
