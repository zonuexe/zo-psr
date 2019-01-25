<?php declare(strict_types=1);

/**
 * PSR-0 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace ZoPsr\Autoload0;

function add_directory(string $directory): void {
	$directory = rtrim($directory, '/\\');

	spl_autoload_register(function ($fqcn) use ($directory) {
		$namespaces = explode('\\', $fqcn);
		$class = array_pop($namespaces);
		$class_file = strtr($class, ['_' => DIRECTORY_SEPARATOR]) . '.php';
		$ns_dir = implode(DIRECTORY_SEPARATOR, $namespaces);
		$file_path = implode(DIRECTORY_SEPARATOR, array_filter([$directory, $ns_dir, $class_file], 'strlen'));

		if (is_file($file_path)) {
			require_once $file_path;
		}
	});
}
