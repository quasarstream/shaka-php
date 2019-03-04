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


namespace Shaka;


use Shaka\Media\Analysis;
use Shaka\Media\DASH;
use Shaka\Media\ExtractStreams;
use Shaka\Process\ShakaProcess;

class Shaka
{

    private $process;

    /**
     * Shaka constructor.
     * @param $process
     */
    public function __construct($process)
    {
        $this->process = $process;
    }

    /**
     * @return Analysis
     */
    public function MediaFileAnalysis()
    {
        return new Analysis($this->process);
    }

    /**
     * @return ExtractStreams
     */
    public function extractStreams()
    {
        return new ExtractStreams($this->process);
    }

    /**
     */
    public function DASH()
    {
        return new DASH($this->process);
    }

    /**
     * @param string $binary
     * @return Shaka
     * @throws Exception\ProcessException
     */
    public static function initialize(string $binary = null)
    {
        $process = new ShakaProcess($binary);
        return new static($process);
    }

}