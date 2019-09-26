<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka;


use Shaka\Exception\StreamException;
use Shaka\Media\Analysis;
use Shaka\Media\Media;
use Shaka\Options\Streams\StreamInterface;
use Shaka\Process\Process;
use Shaka\Process\ShakaProcess;

class Shaka
{
    /** @var Process */
    private $process;

    /** @var array */
    private $streams = [];

    /**
     * Shaka constructor.
     * @param $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    /**
     * @return $this
     * @throws StreamException
     */
    public function streams()
    {
        $streams = func_get_args();

        foreach ($streams as $stream) {
            if (!$stream instanceof StreamInterface) {
                throw new StreamException('Input of stream must be instance of StreamInterface');
            }
        }

        $this->streams = $streams;
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
     * @param array $config
     * @return Shaka
     * @throws Exception\ProcessException
     */
    public static function initialize(array $config = [])
    {
        $process = new ShakaProcess($config);
        return new static($process);
    }

}