<?php

namespace ZoPsr\Cache6;

use Psr\Cache\CacheItemInterface;

/**
 * PSR-6 Cache Item Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class Item implements CacheItemInterface
{
	/** @var string */
	private $_key;
	/** @var mixed */
	private $_value;
	/** @var ?float */
	private $_expiry;
	/** @var bool */
	private $_is_hit = true;

	/**
	 * @param string $key
	 * @param mixed  $value
	 */
	public function __construct(string $key, $value) {
		assert_acceptable_key($key);
		$this->set($value);
		$this->_key = $key;
	}

	public function __set($key, $value) {
		throw new InvalidArgumentException();
	}

	/**
	 * Returns the key for the current cache item.
	 *
	 * The key is loaded by the Implementing Library, but should be available to
	 * the higher level callers when needed.
	 *
	 * @return string
	 *   The key string for this cache item.
	 */
	public function getKey() {
		return $this->_key;
	}

	/**
	 * Retrieves the value of the item from the cache associated with this object's key.
	 *
	 * The value returned must be identical to the value originally stored by set().
	 *
	 * If isHit() returns false, this method MUST return null. Note that null
	 * is a legitimate cached value, so the isHit() method SHOULD be used to
	 * differentiate between "null value was found" and "no value was found."
	 *
	 * @return mixed
	 *   The value corresponding to this cache item's key, or null if not found.
	 */
	public function get() {
		return $this->isHit() ? $this->_value : null;
	}

	/**
	 * Confirms if the cache item lookup resulted in a cache hit.
	 *
	 * Note: This method MUST NOT have a race condition between calling isHit()
	 * and calling get().
	 *
	 * @return bool
	 *   True if the request resulted in a cache hit. False otherwise.
	 */
	public function isHit() {
		return $this->_is_hit;
	}

	/**
	 * Sets the value represented by this cache item.
	 *
	 * The $value argument may be any item that can be serialized by PHP,
	 * although the method of serialization is left up to the Implementing
	 * Library.
	 *
	 * @param mixed $value
	 *   The serializable value to be stored.
	 *
	 * @return static
	 *   The invoked object.
	 */
	public function set($value) {
		assert_acceptable_value($value);
		$this->_value = $value;

		return $this;
	}

	/**
	 * Sets the expiration time for this cache item.
	 *
	 * @param \DateTimeInterface|null $expiration
	 *   The point in time after which the item MUST be considered expired.
	 *   If null is passed explicitly, a default value MAY be used. If none is set,
	 *   the value should be stored permanently or for as long as the
	 *   implementation allows.
	 *
	 * @return static
	 *   The called object.
	 */
	public function expiresAt($expiration) {
		assert_expiration($expiration, __CLASS__ . '::' . __METHOD__);
		$this->_expiry = ($expiration === null) ? null : (float)$expiration->format('U.u');

		if ($expiration !== null) {
			$this->_is_hit = $expiration > new \DateTimeImmutable;
		}

		return $this;
	}

	/**
	 * Sets the expiration time for this cache item.
	 *
	 * @param int|\DateInterval|null $time
	 *   The period of time from the present after which the item MUST be considered
	 *   expired. An integer parameter is understood to be the time in seconds until
	 *   expiration. If null is passed explicitly, a default value MAY be used.
	 *   If none is set, the value should be stored permanently or for as long as the
	 *   implementation allows.
	 *
	 * @return static
	 *   The called object.
	 */
	public function expiresAfter($time) {
		if ($time === null) {
			$expiration =  null;
		} else  {
			$interval = is_int($time) ? new \DateInterval("PT{$time}S") : $time;
			$expiration = (new \DateTimeImmutable)->add($interval);
		}

		return $this->expiresAt($expiration);
	}
}
