<?php declare(strict_types=1);

namespace ZoPsr\Autoload4;

/**
 * PSR-4 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
final class ClassLoader {
	/** @var array<string,string> */
	private $directories = [];

	public function add(string $prefix, string $directory): void {
		$this->directories[$prefix] = $directory;
	}

	public function register(bool $prepend = false)
	{
		spl_autoload_register([$this, 'autoload'], true, $prepend);
	}

	public function autoload(string $class): void {
		$path = $this->_resolve($class);

		if ($path !== null) {
			require_once $path;
		}

	}

	private function _resolve(string $class): ?string {
		foreach ($this->directories as $prefix => $dir) {
			if (strpos($class, $prefix) !== 0) {
				continue;
			}

			$path = $this->_makePath($class, $prefix, $dir);

			if (is_file($path)) {
				return $path;
			}
		}

		return null;
	}

	private function _makePath($class, $prefix, $directory): string
	{
		$relative = substr($class, strlen($prefix));
		$path = strtr($relative, '\\', '/') . '.php';

		return $directory . DIRECTORY_SEPARATOR . $path;
	}
}
