<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Process;


class ShakaProcess extends Process
{
    /**
     * ShakaProcess constructor.
     * @param $binary
     * @throws \Shaka\Exception\ProcessException
     */
    public function __construct($binary)
    {
        $binary = ($binary) ? $binary : "packager";
        parent::__construct($binary);
    }
}