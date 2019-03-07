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


class DASHStream extends DRMStream
{
    /** @var string */
    private $dash_roles;

    /**
     * @param string $dash_roles
     * @return DASHStream
     */
    public function DASHRoles(string $dash_roles): DASHStream
    {
        $this->dash_roles = $dash_roles;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getDashRoles()
    {
        if (!$this->dash_roles) {
            return null;
        }

        return StreamOptions::DASH_ROLES . '=' . $this->dash_roles;
    }
}