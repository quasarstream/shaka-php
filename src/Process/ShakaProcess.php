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
     * @param array $config
     * @throws \Shaka\Exception\ProcessException
     */
    public function __construct(array $config)
    {
        $binary = isset($config['packager.binaries']) ? $config['packager.binaries'] : "packager";
        $timeout = isset($config['timeout']) ? $config['timeout'] : 60;

        parent::__construct($binary, $timeout);
    }
}