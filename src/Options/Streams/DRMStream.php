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


class DRMStream extends Stream
{
    /** @var string */
    private $skip_encryption;

    /** @var string */
    private $drm_label;

    /**
     * @return string
     */
    protected function __getSkipEncryption()
    {
        if (!$this->skip_encryption) {
            return null;
        }

        return StreamOptions::SKIP_ENCRYPTION . '=' . $this->skip_encryption;
    }

    /**
     * @param string $skip_encryption
     * @return $this
     */
    public function skipEncryption(string $skip_encryption)
    {
        $this->skip_encryption = $skip_encryption;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getDrmLabel()
    {
        if (!$this->drm_label) {
            return null;
        }

        return StreamOptions::DRM_LABEL . '=' . $this->drm_label;
    }

    /**
     * @param string $drm_label
     * @return $this
     */
    public function drmLabel(string $drm_label)
    {
        $this->drm_label = $drm_label;
        return $this;
    }
}