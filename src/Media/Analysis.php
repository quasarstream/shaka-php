<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Media;


use Shaka\Exception\StreamException;
use Shaka\Media\AnalysisStream\Stream;
use Shaka\Media\AnalysisStream\StreamCollection;

class Analysis extends ExportMedia
{

    protected $analyse = true;

    /**
     * @return mixed
     * @throws StreamException
     * @throws \Shaka\Exception\ProcessException
     */
    public function export(): StreamCollection
    {
        return $this->parseData();
    }

    /**
     * @return string
     * @throws \Shaka\Exception\ProcessException
     * @throws StreamException
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
        $output = explode(PHP_EOL . PHP_EOL, $this->runCommand());
        $streams = new StreamCollection();

        foreach ($output as $stream) {
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