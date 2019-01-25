<?php declare(strict_types=1);

/**
 * PSR-6 Cache helper function Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace ZoPsr\Cache6;

use Psr\Cache\CacheItemInterface;

function item(string $key, $value): CacheItemInterface {
	return new Item($key, $value);
}

function assert_acceptable_key(string $k): void {
	assert(preg_match('/\A[_.0-9A-Za-z]{1,64}\z/', $k) === 1);
}

/**
 * @param string|int|array|object|null $v
 */
function assert_acceptable_value($v): void {
	if ($v === null) {
		return;
	}
	if (is_string($v)) {
		return;
	}
	if (is_int($v)) {
		return;
	}
	if (is_bool($v)) {
		return;
	}
	if (is_float($v)) {
		return;
	}
	if (is_array($v)) {
		// infinite loop!!!!!
		foreach ($v as $a) {
			assert_acceptable_value($a);
		}

		return;
	}

	assert($v == unserialize(serialize($v)));
}

function assert_expiration($expiration, string $caller): void {
	if (!(null === $expiration || $expiration instanceof \DateTime || $expiration instanceof \DateTimeInterface)) {
		throw new ExpiresAtInvalidParameterException(sprintf(
			'Argument 1 passed to %s must be an instance of DateTime or DateTimeImmutable; %s given',
			$caller,
			is_object($expiration) ? get_class($expiration) : gettype($expiration)
		));
	}
}
