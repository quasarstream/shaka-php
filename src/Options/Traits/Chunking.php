<?php

/**
 * Copyright 2019 Amin Yazdanpanah<http://www.aminyazdanpanah.com>.
 *
 * Licensed under the MIT License;
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      https://opensource.org/licenses/MIT
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
    public function getSegmentDuration()
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
    public function setSegmentDuration(string $segment_duration)
    {
        $this->segment_duration = $segment_duration;
        return $this;
    }

    /**
     * @return array
     */
    public function getFragmentDuration()
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
    public function setFragmentDuration(string $fragment_duration)
    {
        $this->fragment_duration = $fragment_duration;
        return $this;
    }

    /**
     * @return array
     */
    public function getSegmentSapAligned()
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
    public function setSegmentSapAligned(bool $segment_sap_aligned = true)
    {
        $this->segment_sap_aligned = $segment_sap_aligned;
        return $this;
    }

    /**
     * @return array
     */
    public function getFragmentSapAligned()
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
    public function setFragmentSapAligned(bool $fragment_sap_aligned = true)
    {
        $this->fragment_sap_aligned = $fragment_sap_aligned;
        return $this;
    }
    
    
}