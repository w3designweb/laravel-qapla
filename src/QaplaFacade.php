<?php
namespace W3design\Qapla;
use Illuminate\Support\Facades\Facade;

/**
 * Class QaplaFacade
 * @package W3design\Qapla
 */
class QaplaFacade extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'qapla';
	}
}