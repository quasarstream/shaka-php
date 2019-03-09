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


use Shaka\Options\ExportOptions;
use Shaka\Options\MediaOptions;

class Encryption extends ExportOptions
{
    /** @var bool */
    private $vp9_subsample_encryption;

    /** @var bool */
    private $novp9_subsample_encryption;

    /** @var string */
    private $protection_scheme;

    /** @var string */
    private $clear_lead;

    /** @var string */
    private $protection_systems;

    /**
     * @return array
     */
    protected function __getVp9SubsampleEncryption()
    {
        if (!$this->vp9_subsample_encryption) {
            return null;
        }

        return [MediaOptions::VP9_SUBSAMPLE_ENCRYPTION];
    }

    /**
     * @param bool $vp9_subsample_encryption
     * @return Encryption
     */
    public function vp9SubsampleEncryption(bool $vp9_subsample_encryption = true)
    {
        $this->vp9_subsample_encryption = $vp9_subsample_encryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getNovp9SubsampleEncryption()
    {
        if (!$this->novp9_subsample_encryption) {
            return null;
        }

        return [MediaOptions::NOVP9_SUBSAMPLE_ENCRYPTION];
    }

    /**
     * @param bool $novp9_subsample_encryption
     * @return Encryption
     */
    public function novp9SubsampleEncryption(bool $novp9_subsample_encryption = true)
    {
        $this->novp9_subsample_encryption = $novp9_subsample_encryption;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getProtectionScheme()
    {
        if (!$this->protection_scheme) {
            return null;
        }

        return [MediaOptions::PROTECTION_SCHEME, $this->protection_scheme];
    }

    /**
     * @param string $protection_scheme
     * @return Encryption
     */
    public function protectionScheme(string $protection_scheme)
    {
        $this->protection_scheme = $protection_scheme;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getClearLead()
    {
        if (!$this->clear_lead) {
            return null;
        }

        return [MediaOptions::CLEAR_LEAD, $this->clear_lead];
    }

    /**
     * @param string $clear_lead
     * @return Encryption
     */
    public function clearLead(string $clear_lead)
    {
        $this->clear_lead = $clear_lead;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getProtectionSystems()
    {
        if (!$this->protection_systems) {
            return null;
        }

        return [MediaOptions::PROTECTION_SYSTEMS, $this->protection_systems];
    }

    /**
     * @param string $protection_systems
     * @return Encryption
     */
    public function protectionSystems(string $protection_systems)
    {
        $this->protection_systems = $protection_systems;
        return $this;
    }
}