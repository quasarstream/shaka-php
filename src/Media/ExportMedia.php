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


namespace Shaka\Media;


use Shaka\Exception\StreamException;
use Shaka\Options\DASH;
use Shaka\Options\DRM\Encryption;
use Shaka\Options\HLS;
use Shaka\Options\MediaOptions;
use Shaka\Process\Process;

class ExportMedia
{

    /** @var Encryption */
    protected $drm;

    /** @var HLS */
    protected $hls;

    /** @var DASH */
    protected $dash;

    /** @var bool */
    protected $analyse = false;

    /** @var Process */
    protected $process;
    /**
     * @var array
     */
    protected $streams;

    /**
     * MediaFileAnalysis constructor.
     * @param Process $process
     * @param array $streams
     */
    public function __construct(Process $process, array $streams)
    {
        $this->process = $process;
        $this->streams = $streams;
    }

    /**
     * @return string
     * @throws \Shaka\Exception\ProcessException
     * @throws StreamException
     */
    protected function runCommand(): string
    {
        $this->BuildCommand();

        return $this->process->run();
    }

    /**
     * @throws StreamException
     */
    private function BuildCommand()
    {
        // Synopsis
        // 1. Stream Descriptors
        // 2. Dump Stream Info
        // 3. Chunking Options => In trait
        // 4. MP4 Output Options => In trait
        // 5. Ads options => In trait
        // 6. encryption / decryption options
        // 7. HLS options
        // 8. DASH options

        if (empty($this->streams)) {
            throw new StreamException("There is no stream! At least 1 stream must be declared!");
        }

        foreach ($this->streams as $stream) {
            $this->process->addCommand($stream->build());
        }

        if ($this->analyse) {
            $this->process->addCommand(MediaOptions::DUMP_STREAM_INFO);
            return;
        }

        if (null !== $this->drm) {
            $this->process->addCommand($this->drm->export());
        }

        if (null !== $this->hls) {
            $this->process->addCommand($this->hls->export());
        }

        if (null !== $this->dash) {
            $this->process->addCommand($this->dash->export());
        }
    }

    /**
     * @return mixed
     * @throws \Shaka\Exception\ProcessException
     * @throws StreamException
     */
    public function export()
    {
        return $this->runCommand();
    }
}