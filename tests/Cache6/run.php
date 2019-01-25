#!/usr/bin/env php
<?php declare(strict_types=1);

/**
 * Test script for PSR-0 Autoload Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

use ZoPsr\Cache6\ArrayPool;
use Psr\Cache\CacheItemInterface;

require_once __DIR__ . '/../../vendor/autoload.php';

$pool = new ArrayPool;

$item = $pool->getItem('hoge');
assert($item instanceof CacheItemInterface);
assert($item->getKey() === 'hoge');
assert($item === $item->set("aaaaaa"));

$pool->save($item);
$pool->commit();

assert($item === $pool->getItem('hoge'));
assert(['hoge' => $item] === $pool->getItems(['hoge']));


echo "p(ixi)v", PHP_EOL;
