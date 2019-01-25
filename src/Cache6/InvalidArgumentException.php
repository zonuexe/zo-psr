<?php

namespace ZoPsr\Cache6;

use Psr\Cache\InvalidArgumentException as InvalidArgumentExceptionIntarface;

/**
 * Exception interface for invalid cache arguments.
 *
 * Any time an invalid argument is passed into a method it must throw an
 * exception class which implements Psr\Cache\InvalidArgumentException.
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class InvalidArgumentException extends \InvalidArgumentException implements InvalidArgumentExceptionIntarface {
}
