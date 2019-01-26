#!/usr/bin/env php
<?php

/**
 * Test script for PSR-3 Logger Implementation
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

use Psr\Log\LogLevel;
use ZoPsr\Log3\FileLogger;

require_once __DIR__ . '/../../vendor/autoload.php';

$fp = fopen('php://memory', 'rw');
$logger = new FileLogger($fp, LogLevel::NOTICE);

$logger->emergency('エマージェンシー');
$logger->alert('アラート');
$logger->critical('クリティカル');
$logger->error('エラー');
$logger->warning('ウォーニング');
$logger->notice('ノーティス');
$logger->info('インフォ');
$logger->debug('デバッグ');

rewind($fp);
$output = stream_get_contents($fp);

assert($output === '{"level":"emergency","message":"\u30a8\u30de\u30fc\u30b8\u30a7\u30f3\u30b7\u30fc","context":[]}
{"level":"alert","message":"\u30a2\u30e9\u30fc\u30c8","context":[]}
{"level":"critical","message":"\u30af\u30ea\u30c6\u30a3\u30ab\u30eb","context":[]}
{"level":"error","message":"\u30a8\u30e9\u30fc","context":[]}
{"level":"warning","message":"\u30a6\u30a9\u30fc\u30cb\u30f3\u30b0","context":[]}
{"level":"notice","message":"\u30ce\u30fc\u30c6\u30a3\u30b9","context":[]}
');

echo 'p(ixi)v ', __FILE__, PHP_EOL;
