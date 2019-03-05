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
use Shaka\Media\Media;
use Shaka\Options\DASH;
use Shaka\Options\Streams\StreamInterface;
use Shaka\Process\Process;
use Shaka\Process\ShakaProcess;

class Shaka
{
    /** @var Process */
    private $process;

    /** @var array */
    private $streams = [];

    /** @var DASH */
    private $dash;

    /**
     * Shaka constructor.
     * @param $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    /**
     * @param StreamInterface $stream
     * @return $this
     */
    public function addStream(StreamInterface $stream)
    {
        $this->streams[] = $stream;
        return $this;
    }

    /**
     * @return Analysis
     */
    public function mediaFileAnalysis(): Analysis
    {
        return new Analysis($this->process, $this->streams);
    }

    /**
     * @return Media
     */
    public function mediaPackaging()
    {
        return new Media($this->process, $this->streams);
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