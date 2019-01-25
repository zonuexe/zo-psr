#!/usr/bin/env php
<?php

/**
 * Test script for PSR-0 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

use ZoPsr\Autoload4\ClassLoader;
use function ZoPsr\TestHelper\capture;

require_once __DIR__ . '/../../vendor/autoload.php';

$loader = new ClassLoader;
$loader->register(false);

$loader->add('Foo\\', __DIR__ . '/1');
$loader->add('Hoge\\', __DIR__ . '/2');

$output = capture(function () {
	$foo = new \Foo\Bar;
	$hoge = new \Hoge\Fuga_Piyo;
});

assert($output === 'Foo\\Bar
Hoge\\Fuga_Piyo
');

echo 'p(ixi)v ', __FILE__, PHP_EOL;
