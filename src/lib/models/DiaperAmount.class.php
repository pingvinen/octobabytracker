<?php

class DiaperAmount
{
	const NONE = 0;
	const A_LITTLE = 1;
	const SOME = 2;
	const WOW = 3;
	const HOLY_CRAP = 4;

	public static function asString($amount)
	{
		switch ($amount)
		{
			case self::NONE:
				return 'None';

			case self::A_LITTLE:
				return 'A little';

			case self::SOME:
				return 'Some';

			case self::WOW:
				return 'WOW';

			case self::HOLY_CRAP:
				return 'Holy crap!';
		}

		return '';
	}

	public static function all()
	{
		return array(
			  self::NONE
			, self::A_LITTLE
			, self::SOME
			, self::WOW
			, self::HOLY_CRAP
		);
	}
}
