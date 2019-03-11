<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\DRM;


use Shaka\Options\MediaOptions;

class Raw extends Encryption
{
    /** @var bool */
    private $enable_raw_key_encryption;

    /** @var bool */
    private $enable_raw_key_decryption;

    /** @var string */
    private $keys;

    /** @var string */
    private $iv;

    /** @var string */
    private $pssh;

    /**
     * @return array
     */
    protected function __getEnableRawKeyEncryption()
    {
        if (!$this->enable_raw_key_encryption) {
            return null;
        }

        return [MediaOptions::ENABLE_RAW_KEY_ENCRYPTION];
    }

    /**
     * @param bool $enable_raw_key_encryption
     * @return Raw
     */
    public function enableEncryption(bool $enable_raw_key_encryption = true): Raw
    {
        $this->enable_raw_key_encryption = $enable_raw_key_encryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getEnableRawKeyDecryption()
    {
        if (!$this->enable_raw_key_decryption) {
            return null;
        }

        return [MediaOptions::ENABLE_RAW_KEY_DECRYPTION];
    }

    /**
     * @param bool $enable_raw_key_decryption
     * @return Raw
     */
    public function enableRawKeyDecryption(bool $enable_raw_key_decryption = true): Raw
    {
        $this->enable_raw_key_decryption = $enable_raw_key_decryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getKeys()
    {
        if (!$this->keys) {
            return null;
        }

        return [MediaOptions::KEYS, $this->keys];
    }

    /**
     * @param string $keys
     * @return Raw
     */
    public function keys(string $keys): Raw
    {
        $this->keys = $keys;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getIv()
    {
        if (!$this->iv) {
            return null;
        }

        return [MediaOptions::IV, $this->iv];
    }

    /**
     * @param string $iv
     * @return Raw
     */
    public function iv(string $iv): Raw
    {
        $this->iv = $iv;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getPssh()
    {
        if (!$this->pssh) {
            return null;
        }

        return [MediaOptions::PSSH, $this->pssh];
    }

    /**
     * @param string $pssh
     * @return Raw
     */
    public function pssh(string $pssh): Raw
    {
        $this->pssh = $pssh;
        return $this;
    }

}