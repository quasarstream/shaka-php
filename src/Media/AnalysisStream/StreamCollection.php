<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
