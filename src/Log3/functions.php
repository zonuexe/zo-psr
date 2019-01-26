<?php declare(strict_types=1);

namespace ZoPsr\Log3;

use Psr\Log\LogLevel;

function to_num(string $level): int {
	return [
		LogLevel::EMERGENCY => 0,
		LogLevel::ALERT     => 1,
		LogLevel::CRITICAL  => 2,
		LogLevel::ERROR     => 3,
		LogLevel::WARNING   => 4,
		LogLevel::NOTICE    => 5,
		LogLevel::INFO      => 6,
		LogLevel::DEBUG     => 7,
	][$level];
}
