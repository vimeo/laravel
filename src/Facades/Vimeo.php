<?php

namespace Vinkla\Vimeo\Facades;

use Illuminate\Support\Facades\Facade;

class Vimeo extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'vimeo';
	}
}
