<?php declare(strict_types=1);

namespace ZoPsr\Log3;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

/**
 * PSR-4 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class FileLogger implements LoggerInterface {
	use LoggerTrait;

	/** @var resource */
	private $_fp;
	/** @var string */
	private $_min_level;

	/**
	 * @param resource $fp
	 * @param ?string $min_level
	 */
	public function __construct($fp, $min_level = null) {
		$this->_fp = $fp;
		$this->_min_level = $min_level ?? LogLevel::WARNING;
	}

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param mixed  $level
	 * @param string $message
	 * @param array  $context
	 * @return void
	 */
	public function log($level, $message, array $context = []) {
		if (to_num($level) <= to_num($this->_min_level)) {
			$log = json_encode([
				'level' => $level,
				'message' => $message,
				'context' => $context,
			], JSON_UNESCAPED_SLASHES) ?: '{"json_encode_error":true}}';
			fputs($this->_fp, $log);
			fputs($this->_fp, "\n");
		}
	}
}
