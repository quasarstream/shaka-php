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

trait Chunking
{
    /** @var string*/
    private $segment_duration;

    /** @var string*/
    private $fragment_duration;

    /** @var bool*/
    private $segment_sap_aligned;

    /** @var bool*/
    private $fragment_sap_aligned;

    /**
     * @return array
     */
    protected function __getSegmentDuration()
    {
        if (!$this->segment_duration) {
            return null;
        }

        return [MediaOptions::SEGMENT_DURATION, $this->segment_duration];
    }

    /**
     * @param string $segment_duration
     * @return Chunking
     */
    public function segmentDuration(string $segment_duration)
    {
        $this->segment_duration = $segment_duration;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getFragmentDuration()
    {
        if (!$this->fragment_duration) {
            return null;
        }

        return [MediaOptions::FRAGMENT_DURATION, $this->fragment_duration];
    }

    /**
     * @param string $fragment_duration
     * @return Chunking
     */
    public function fragmentDuration(string $fragment_duration)
    {
        $this->fragment_duration = $fragment_duration;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getSegmentSapAligned()
    {
        if (!$this->segment_sap_aligned) {
            return null;
        }

        return [MediaOptions::SEGMENT_SAP_ALIGNED];
    }

    /**
     * @param bool $segment_sap_aligned
     * @return Chunking
     */
    public function segmentSapAligned(bool $segment_sap_aligned = true)
    {
        $this->segment_sap_aligned = $segment_sap_aligned;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getFragmentSapAligned()
    {
        if (!$this->fragment_sap_aligned) {
            return null;
        }

        return [MediaOptions::FRAGMENT_SAP_ALIGNED];
    }

    /**
     * @param bool $fragment_sap_aligned
     * @return Chunking
     */
    public function fragmentSapAligned(bool $fragment_sap_aligned = true)
    {
        $this->fragment_sap_aligned = $fragment_sap_aligned;
        return $this;
    }
    
    
}