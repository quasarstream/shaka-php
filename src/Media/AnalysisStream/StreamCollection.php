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


namespace Shaka\Media\AnalysisStream;


class StreamCollection implements \Countable, \IteratorAggregate
{
    private $streams;


    /**
     * @param Stream $stream
     * @return $this
     */
    public function addStream(Stream $stream)
    {
        $this->streams[] = $stream;

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->streams;
    }

    /**
     * @return StreamCollection
     */
    public function audios()
    {
        return array_filter($this->streams, function (Stream $stream) {
            return $stream->isAudio();
        });
    }

    /**
     * @return StreamCollection
     */
    public function videos()
    {
        return array_filter($this->streams, function (Stream $stream) {
            return $stream->isVideo();
        });
    }

    /**
     * @return null | Stream
     */
    public function first()
    {
        $stream = current($this->streams);

        return $stream ?: null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->streams);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->streams);
    }
}
