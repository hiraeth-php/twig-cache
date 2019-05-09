<?php

namespace Hiraeth\Twig\Cache;

use RuntimeException;
use Twig\CacheExtension\CacheStrategy;

class KeyGenerator implements CacheStrategy\KeyGeneratorInterface
{
	/**
	 *
	 */
    public function generateKey($value)
    {
		if (!$value instanceof KeyGeneratorInterface) {
			throw new RuntimeException(sprintf(
				'Invalid key provided for cache, must implement "%s"',
				KeyGeneratorInterface::class
			));
		}

		return $value->generateKey();
    }
}
