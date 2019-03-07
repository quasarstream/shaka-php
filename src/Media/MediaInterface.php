<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Media;


use Shaka\Options\DRM\Encryption;

interface MediaInterface
{
    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     */
    public function DASH(string $output, callable $options = null);

    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     */
    public function HLS(string $output, callable $options = null);

    /**
     * @param string $encryption
     * @param callable|null $options
     * @return Media
     */
    public function DRM(string $encryption, callable $options = null);
}