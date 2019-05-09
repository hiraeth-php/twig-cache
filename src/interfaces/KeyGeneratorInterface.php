<?php

namespace Hiraeth\Twig\Cache;


/**
 *
 */
interface KeyGeneratorInterface
{
	public function generateKey(): string;
}
