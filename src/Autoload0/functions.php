<?php declare(strict_types=1);

/**
 * PSR-0 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace ZoPsr\Autoload0;

function add_directory(string $directory): void {
	$directory = rtrim(rtrim($directory, '/'), '\\');

	spl_autoload_register(function ($class) use ($directory) {
		$path = strtr($class, ['\\' => '/', '_' => '/']) . '.php';

		if (is_file($directory . DIRECTORY_SEPARATOR . $path)) {
			require $directory . DIRECTORY_SEPARATOR . $path;
		}
	});
}
