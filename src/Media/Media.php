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


use Shaka\Exception\MediaException;
use Shaka\Options\DASH;
use Shaka\Options\ExportOptions;
use Shaka\Options\HLS;

class Media extends ExportMedia implements MediaInterface
{
    /**
     * @param string $encryption
     * @param callable|null $options
     * @return Media
     * @throws MediaException
     */
    public function DRM(string $encryption, callable $options = null)
    {
        $class_name = '\Shaka\Options\DRM\\' . ucwords($encryption);

        if (!class_exists($class_name)) {
            throw new MediaException('There is no encryption class related to this string!');
        }

        $drm = new $class_name();
        $drm = $drm->enableEncryption();
        $this->drm = $this->getOptions($drm, $options);

        return $this;
    }

    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     * @throws MediaException
     */
    public function HLS(string $output, callable $options = null)
    {
        $hls = new HLS();
        $hls = $hls->HLSMasterPlaylistOutput($output);
        $this->hls = $this->getOptions($hls, $options);

        return $this;
    }

    /**
     * @param string $output
     * @param callable|null $options
     * @return $this
     * @throws MediaException
     */
    public function DASH(string $output, callable $options = null)
    {
        $dash = new DASH();
        $dash = $dash->mpdOutput($output);
        $this->dash = $this->getOptions($dash, $options);

        return $this;
    }

    /**
     * @param $media
     * @param $instance
     * @throws MediaException
     */
    private function isExportable($media, $instance = null)
    {
        $instance = (null === $instance) ? (new ExportOptions()) : $instance;

        if (!$media instanceof $instance) {
            throw new MediaException("The options are not valid! Please check your options.");
        }
    }

    /**
     * @param ExportOptions $media
     * @param callable|null $options
     * @return ExportOptions
     * @throws MediaException
     */
    private function getOptions(ExportOptions $media, ?callable $options)
    {

        $media1 = clone $media;

        if (is_callable($options)) {
            $media = $options($media);
        }

        $this->isExportable($media, $media1);

        return $media;
    }
}