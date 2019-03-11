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

class PlayReady extends Encryption
{
    /** @var bool */
    private $enable_playready_encryption;

    /** @var string */
    private $playready_server_url;

    /** @var string */
    private $program_identifier;

    /** @var string */
    private $ca_file;

    /** @var string */
    private $client_cert_file;

    /** @var string */
    private $client_cert_private_key_file;

    /** @var string */
    private $client_cert_private_key_password;

    /**
     * @return array
     */
    protected function __getEnablePlayreadyEncryption()
    {
        if (!$this->enable_playready_encryption) {
            return null;
        }

        return [MediaOptions::ENABLE_PLAYREADY_ENCRYPTION];
    }

    /**
     * @param bool $enable_playready_encryption
     * @return PlayReady
     */
    public function enableEncryption(bool $enable_playready_encryption = true): PlayReady
    {
        $this->enable_playready_encryption = $enable_playready_encryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getPlayreadyServerUrl()
    {
        if (!$this->playready_server_url) {
            return null;
        }

        return [MediaOptions::PLAYREADY_SERVER_URL, $this->playready_server_url];
    }

    /**
     * @param string $playready_server_url
     * @return PlayReady
     */
    public function playreadyServerUrl(string $playready_server_url): PlayReady
    {
        $this->playready_server_url = $playready_server_url;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getProgramIdentifier()
    {
        if (!$this->program_identifier) {
            return null;
        }

        return [MediaOptions::PROGRAM_IDENTIFIER, $this->program_identifier];
    }

    /**
     * @param string $program_identifier
     * @return PlayReady
     */
    public function programIdentifier(string $program_identifier): PlayReady
    {
        $this->program_identifier = $program_identifier;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getCaFile()
    {
        if (!$this->ca_file) {
            return null;
        }

        return [MediaOptions::CA_FILE, $this->ca_file];
    }

    /**
     * @param string $ca_file
     * @return PlayReady
     */
    public function caFile(string $ca_file): PlayReady
    {
        $this->ca_file = $ca_file;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getClientCertFile()
    {
        if (!$this->client_cert_file) {
            return null;
        }

        return [MediaOptions::CLIENT_CERT_FILE, $this->client_cert_file];
    }

    /**
     * @param string $client_cert_file
     * @return PlayReady
     */
    public function clientCertFile(string $client_cert_file): PlayReady
    {
        $this->client_cert_file = $client_cert_file;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getClientCertPrivateKeyFile()
    {
        if (!$this->client_cert_private_key_file) {
            return null;
        }

        return [MediaOptions::CLIENT_CERT_PRIVATE_KEY_FILE, $this->client_cert_private_key_file];
    }

    /**
     * @param string $client_cert_private_key_file
     * @return PlayReady
     */
    public function clientCertPrivateKeyFile(string $client_cert_private_key_file): PlayReady
    {
        $this->client_cert_private_key_file = $client_cert_private_key_file;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getClientCertPrivateKeyPassword()
    {
        if (!$this->client_cert_private_key_password) {
            return null;
        }

        return [MediaOptions::CLIENT_CERT_PRIVATE_KEY_PASSWORD, $this->client_cert_private_key_password];
    }

    /**
     * @param string $client_cert_private_key_password
     * @return PlayReady
     */
    public function clientCertPrivateKeyPassword(string $client_cert_private_key_password): PlayReady
    {
        $this->client_cert_private_key_password = $client_cert_private_key_password;
        return $this;
    }

}