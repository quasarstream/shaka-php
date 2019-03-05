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
use Shaka\Media\AnalysisStream\Stream;
use Shaka\Media\AnalysisStream\StreamCollection;

class Analysis extends ExportMedia
{
    /**
     * @return mixed
     * @throws StreamException
     * @throws \Shaka\Exception\ProcessException
     */
    public function export(): StreamCollection
    {
        $this->analyse = true;
        return $this->parseData();
    }

    /**
     * @return string
     * @throws \Shaka\Exception\ProcessException
     */
    public function __toString()
    {
        return $this->runCommand();
    }


    /**
     * @return StreamCollection
     * @throws \Shaka\Exception\ProcessException
     * @throws StreamException
     */
    private function parseData(): StreamCollection
    {
        $Streams = explode(PHP_EOL . PHP_EOL, $this->runCommand());
        $streams = new StreamCollection();

        foreach ($Streams as $key => $stream) {
            if (strstr($stream, "Stream [")) {

                $stream_object = new Stream();
                $attributes = explode(PHP_EOL, trim(preg_replace(['/(?:File) "(.*)":/', '/(?:Found) (?P<digit>\d+) (?:stream)\(s\)./', '/(?:Stream) (\[)(?P<digit>\d+)(\]) /'], '', $stream)));

                foreach ($attributes as $attribute) {
                    $attribute = explode(": ", trim($attribute));
                    $stream_object = $stream_object->addAttr($attribute[0], $attribute[1]);
                }

                $streams->addStream($stream_object);
            }
        }

        if (!$streams->all()) {
            throw new StreamException("There is no Stream in the file!");
        }

        return $streams;
    }
}