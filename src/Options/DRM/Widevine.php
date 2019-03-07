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

class Widevine extends Encryption
{
    /** @var bool */
    private $enable_widevine_encryption;

    /** @var bool */
    private $enable_widevine_decryption;

    /** @var string */
    private $key_server_url;

    /** @var string */
    private $content_id;

    /** @var string */
    private $policy;

    /** @var string */
    private $max_sd_pixels;

    /** @var string */
    private $max_hd_pixels;

    /** @var string */
    private $max_uhd1_pixels;

    /** @var string */
    private $signer;

    /** @var string */
    private $aes_signing_key;

    /** @var string */
    private $aes_signing_iv;

    /** @var string */
    private $rsa_signing_key_path;

    /** @var string */
    private $crypto_period_duration;

    /** @var string */
    private $group_id;

    /**
     * @return array
     */
    protected function __getEnableWidevineEncryption()
    {
        if (!$this->enable_widevine_encryption) {
            return null;
        }

        return [MediaOptions::ENABLE_WIDEVINE_ENCRYPTION];
    }

    /**
     * @param bool $enable_widevine_encryption
     * @return Widevine
     */
    public function enableEncryption(bool $enable_widevine_encryption = true): Widevine
    {
        $this->enable_widevine_encryption = $enable_widevine_encryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getEnableWidevineDecryption()
    {
        if (!$this->enable_widevine_decryption) {
            return null;
        }

        return [MediaOptions::ENABLE_WIDEVINE_DECRYPTION];
    }

    /**
     * @param bool $enable_widevine_decryption
     * @return Widevine
     */
    public function enableWidevineDecryption(bool $enable_widevine_decryption = true): Widevine
    {
        $this->enable_widevine_decryption = $enable_widevine_decryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getKeyServerUrl()
    {
        if (!$this->key_server_url) {
            return null;
        }

        return [MediaOptions::KEY_SERVER_URL, $this->key_server_url];
    }

    /**
     * @param string $key_server_url
     * @return Widevine
     */
    public function keyServerUrl(string $key_server_url): Widevine
    {
        $this->key_server_url = $key_server_url;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getContentId()
    {
        if (!$this->content_id) {
            return null;
        }

        return [MediaOptions::CONTENT_ID, $this->content_id];
    }

    /**
     * @param string $content_id
     * @return Widevine
     */
    public function contentId(string $content_id): Widevine
    {
        $this->content_id = $content_id;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getPolicy()
    {
        if (!$this->policy) {
            return null;
        }

        return [MediaOptions::POLICY, $this->policy];
    }

    /**
     * @param string $policy
     * @return Widevine
     */
    public function policy(string $policy): Widevine
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getMaxSdPixels()
    {
        if (!$this->max_sd_pixels) {
            return null;
        }

        return [MediaOptions::MAX_SD_PIXELS, $this->max_sd_pixels];
    }

    /**
     * @param string $max_sd_pixels
     * @return Widevine
     */
    public function maxSdPixels(string $max_sd_pixels): Widevine
    {
        $this->max_sd_pixels = $max_sd_pixels;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getMaxHdPixels()
    {
        if (!$this->max_hd_pixels) {
            return null;
        }

        return [MediaOptions::MAX_HD_PIXELS, $this->max_hd_pixels];
    }

    /**
     * @param string $max_hd_pixels
     * @return Widevine
     */
    public function maxHdPixels(string $max_hd_pixels): Widevine
    {
        $this->max_hd_pixels = $max_hd_pixels;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getMaxUhd1Pixels()
    {
        if (!$this->max_uhd1_pixels) {
            return null;
        }

        return [MediaOptions::MAX_UHD1_PIXELS, $this->max_uhd1_pixels];
    }

    /**
     * @param string $max_uhd1_pixels
     * @return Widevine
     */
    public function maxUhd1Pixels(string $max_uhd1_pixels): Widevine
    {
        $this->max_uhd1_pixels = $max_uhd1_pixels;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getSigner()
    {
        if (!$this->signer) {
            return null;
        }

        return [MediaOptions::SIGNER, $this->signer];
    }

    /**
     * @param string $signer
     * @return Widevine
     */
    public function signer(string $signer): Widevine
    {
        $this->signer = $signer;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getAesSigningKey()
    {
        if (!$this->aes_signing_key) {
            return null;
        }

        return [MediaOptions::AES_SIGNING_KEY, $this->aes_signing_key];
    }

    /**
     * @param string $aes_signing_key
     * @return Widevine
     */
    public function aesSigningKey(string $aes_signing_key): Widevine
    {
        $this->aes_signing_key = $aes_signing_key;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getAesSigningIv()
    {
        if (!$this->aes_signing_iv) {
            return null;
        }

        return [MediaOptions::AES_SIGNING_IV, $this->aes_signing_iv];
    }

    /**
     * @param string $aes_signing_iv
     * @return Widevine
     */
    public function aesSigningIv(string $aes_signing_iv): Widevine
    {
        $this->aes_signing_iv = $aes_signing_iv;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getRsaSigningKeyPath()
    {
        if (!$this->rsa_signing_key_path) {
            return null;
        }

        return [MediaOptions::RSA_SIGNING_KEY_PATH, $this->rsa_signing_key_path];
    }

    /**
     * @param string $rsa_signing_key_path
     * @return Widevine
     */
    public function rsaSigningKeyPath(string $rsa_signing_key_path): Widevine
    {
        $this->rsa_signing_key_path = $rsa_signing_key_path;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getCryptoPeriodDuration()
    {
        if (!$this->crypto_period_duration) {
            return null;
        }

        return [MediaOptions::CRYPTO_PERIOD_DURATION, $this->crypto_period_duration];
    }

    /**
     * @param string $crypto_period_duration
     * @return Widevine
     */
    public function cryptoPeriodDuration(string $crypto_period_duration): Widevine
    {
        $this->crypto_period_duration = $crypto_period_duration;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getGroupId()
    {
        if (!$this->group_id) {
            return null;
        }

        return [MediaOptions::GROUP_ID, $this->group_id];
    }

    /**
     * @param string $group_id
     * @return Widevine
     */
    public function groupId(string $group_id): Widevine
    {
        $this->group_id = $group_id;
        return $this;
    }
}