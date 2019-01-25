#!/usr/bin/env php
<?php

/**
 * Test script for PSR-0 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

use function ZoPsr\Autoload0\add_directory;
use function ZoPsr\TestHelper\capture;

require_once __DIR__ . '/../../vendor/autoload.php';

add_directory(__DIR__);

$output = capture(function () {
	$foo = new Foo_Bar;
	$hoge = new \Hoge\Fuga\Piyo;
});

assert($output === 'Foo_Bar
Hoge\\Fuga\\Piyo
');

echo 'p(ixi)v', PHP_EOL;
