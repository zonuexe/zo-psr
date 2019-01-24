<?php

/**
 * Helper function for ZoPsr testing
 *
 * @copyright 2019 USAMI Kenta
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace ZoPsr\TestHelper;

function capture(\Closure $callback): string
{
    ob_start();
    try {
        $callback();
    } catch (\Throwable $e) {
        ob_end_clean();
        throw $e;
    }

    return ob_get_clean();
}
