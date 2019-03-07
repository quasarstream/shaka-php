<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Streams;


interface StreamInterface
{
    /**
     * @param string $input
     * @return $this
     */
    public static function Input(string $input);

    /**
     * @param string $output
     * @return $this
     */
    public function Output(string $output);
}