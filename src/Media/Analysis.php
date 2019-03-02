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

class Analysis extends ExportMedia
{
    /** @var array*/
    private $streams = [];

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
     * @return Analysis
     */
    public function addStream(StreamInterface $stream)
    {
        $this->streams[] = $stream;
        return $this;
    }

    /**
     * @param bool $json
     * @return mixed
     * @throws \Shaka\Exception\ProcessException
     */
    public function export(bool $json = false)
    {
        $data = $this->parseData();
        return ($json) ? json_encode($data) : $data;
    }

    /**
     * @return array
     * @throws \Shaka\Exception\ProcessException
     */
    private function parseData(): array
    {
        $output = $this->runCommand();
        preg_match('/(?:Found) (?P<digit>\d+)/', $output, $stream);
        $extract = ["count_stream" => $stream[1]];
        $Streams = explode(PHP_EOL . PHP_EOL, $output);
        foreach ($Streams as $key => $stream){
            if(strstr($stream, "Stream")){
                $attrs = [];
                $attributes = explode(PHP_EOL, trim(preg_replace(['/(?:File) "(.*)":/', '/(?:Found) (?P<digit>\d+) (?:stream)\(s\)./', '/(?:Stream) (\[)(?P<digit>\d+)(\]) /'],'',$stream)));
                foreach ($attributes as $attribute){
                    $attribute = explode(": ", trim($attribute));
                    $attrs = array_merge($attrs, [$attribute[0] => $attribute[1]]);
                }
                $extract = array_merge($extract, ["stream_" . $key => $attrs]);
            }
        }
        return $extract;
    }



    protected function BuildCommand(): void
    {
        foreach ($this->streams as $stream){
            $this->process->addCommand($stream->build());
        }

        $this->process->addCommand("--dump_stream_info");
    }
}