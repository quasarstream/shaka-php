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