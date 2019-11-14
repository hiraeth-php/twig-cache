<?php

namespace Hiraeth\Twig\Cache;

use Hiraeth\Caching;
use RuntimeException;
use Twig\CacheExtension\CacheStrategy;

class KeyGenerator implements CacheStrategy\KeyGeneratorInterface
{
	/**
	 *
	 */
	public function generateKey($value)
	{
		if (!$value instanceof Caching\KeyGenerator) {
			throw new RuntimeException(sprintf(
				'Invalid key provided for cache, must implement "%s"',
				Caching\KeyGenerator::class
			));
		}

		return $value->generateCacheKey();
	}
}
