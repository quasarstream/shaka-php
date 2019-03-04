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


use Shaka\Process\Process;
use Shaka\Streams\StreamInterface;

class ExportMedia
{
    /** @var Process */
    protected $process;

    /** @var array */
    protected $streams = [];

    /**
     * MediaFileAnalysis constructor.
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
     * @return string
     * @throws \Shaka\Exception\ProcessException
     */
    protected function runCommand(): string
    {
        $this->BuildCommand();

        return $this->process->run();
    }

    protected function options()
    {
        $options = [];
        $get_methods = preg_grep('/^get/', get_class_methods($this));

        foreach ($get_methods as $method) {
            if (null !== ($option = $this->{$method}())) {
                $options[] = $option;
            }
        }

        return $options;
    }

}