<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function ZoPsr\Autoload0\add_directory;
use ZoPsr\Autoload4\ClassLoader;

add_directory(__DIR__ . '/Autoload0');

$loader = new ClassLoader;
$loader->register(false);
$loader->add('Foo\\', __DIR__ . '/Autoload4/1');
$loader->add('Hoge\\', __DIR__ . '/Autoload4/2');
