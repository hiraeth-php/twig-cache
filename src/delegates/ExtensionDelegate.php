<?php

namespace Hiraeth\Twig\Cache;

use Hiraeth;
use Twig\CacheExtension\Extension;
use Twig\CacheExtension\CacheProvider\PsrCacheAdapter;
use Twig\CacheExtension\CacheStrategy\LifetimeCacheStrategy;
use Twig\CacheExtension\CacheStrategy\BlackholeCacheStrategy;
use Twig\CacheExtension\CacheStrategy\GenerationalCacheStrategy;
use Twig\CacheExtension\CacheStrategy\IndexedChainingCacheStrategy;

/**
 *
 */
class ExtensionDelegate implements Hiraeth\Delegate
{
	/**
	 * Get the class for which the delegate operates.
	 *
	 * @static
	 * @access public
	 * @return string The class for which the delegate operates
	 */
	static public function getClass(): string
	{
		return Extension::class;
	}


	/**
	 * Get the instance of the class for which the delegate operates.
	 *
	 * @access public
	 * @param Hiraeth\Application $app The application instance for which the delegate operates
	 * @return object The instance of the class for which the delegate operates
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		if ($app->getEnvironment('CACHING', FALSE)) {
			$adapter  = $app->get(PsrCacheAdapter::class);
			$strategy = new IndexedChainingCacheStrategy([
				'ttl' => new LifetimeCacheStrategy($adapter),
				'key' => new GenerationalCacheStrategy($adapter, new KeyGenerator(), 0)
			]);

		} else {
			$strategy = new BlackholeCacheStrategy();
		}

		return new Extension($strategy);
	}
}
