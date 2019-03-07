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


use Shaka\Options\DASH;
use Shaka\Options\DRM\Encryption;
use Shaka\Options\HLS;

class Media extends ExportMedia implements MediaInterface
{
    /**
     * @param Encryption $drm
     * @return Media
     */
    public function DRM(Encryption $drm)
    {
        $this->drm = $drm;
        return $this;
    }

    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     */
    public function HLS(string $output, callable $options = null)
    {
        $hls = new HLS();
        $hls = $hls->HLSMasterPlaylistOutput($output);

        if(is_callable($options)) {
            $hls = $options($hls);
        }

        $this->hls = $hls;
        return $this;
    }

    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     */
    public function DASH(string $output, callable $options = null)
    {
        $dash = new DASH();
        $dash = $dash->mpdOutput($output);

        if(is_callable($options)) {
            $dash = $options($dash);
        }

        $this->dash = $dash;
        return $this;
    }
}