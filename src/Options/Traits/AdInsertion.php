<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Traits;


use Shaka\Options\MediaOptions;

trait AdInsertion
{
    /** @var string*/
    private $ad_cues;

    /**
     * @param string $ad_cues
     * @return AdInsertion
     */
    public function adCues(string $ad_cues)
    {
        $this->ad_cues = $ad_cues;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getAdCues()
    {
        if (!$this->ad_cues) {
            return null;
        }

        return [MediaOptions::AD_CUES, $this->ad_cues];
    }
}