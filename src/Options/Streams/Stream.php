<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Streams;


class Stream extends BuildStream
{
    /** @var string */
    private $input;

    /** @var string */
    private $stream_selector;

    /** @var string */
    private $output;

    /** @var string */
    private $init_segment;

    /** @var string */
    private $segment_template;

    /** @var string */
    private $bandwidth;

    /** @var string */
    private $language;

    /** @var string */
    private $output_format;

    /** @var string */
    private $trick_play_factor;

    /**
     * Stream constructor.
     * @param string $input
     */
    public function __construct(string $input)
    {
        $this->input = $input;
    }

    /**
     * @return string
     */
    protected function __getInput()
    {
        if (!$this->input) {
            return null;
        }

        return StreamOptions::INPUT . '=' . $this->input;
    }

    /**
     * @param string $input
     * @return $this
     */
    public static function input(string $input)
    {
        return new static($input);
    }

    /**
     * @return string
     */
    protected function __getStreamSelector()
    {
        if (!isset($this->stream_selector)) {
            return null;
        }

        return StreamOptions::STREAM_SELECTOR . '=' . $this->stream_selector;
    }

    /**
     * @param string $stream_selector
     * @return $this
     */
    public function streamSelector(string $stream_selector)
    {
        $this->stream_selector = $stream_selector;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getOutput()
    {
        if (!$this->output) {
            return null;
        }

        return StreamOptions::OUTPUT . '=' . $this->output;
    }

    /**
     * @param string $output
     * @return $this
     */
    public function output(string $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getInitSegment()
    {
        if (!$this->init_segment) {
            return null;
        }

        return StreamOptions::INIT_SEGMENT . '=' . $this->init_segment;
    }

    /**
     * @param string $init_segment
     * @return $this
     */
    public function initSegment(string $init_segment)
    {
        $this->init_segment = $init_segment;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getSegmentTemplate()
    {
        if (!$this->segment_template) {
            return null;
        }

        return StreamOptions::SEGMENT_TEMPLATE . '=' . $this->segment_template;
    }

    /**
     * @param string $segment_template
     * @return $this
     */
    public function segmentTemplate(string $segment_template)
    {
        $this->segment_template = $segment_template;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getBandwidth()
    {
        if (!$this->bandwidth) {
            return null;
        }

        return StreamOptions::BANDWIDTH . '=' . $this->bandwidth;
    }

    /**
     * @param string $bandwidth
     * @return $this
     */
    public function bandwidth(string $bandwidth)
    {
        $this->bandwidth = $bandwidth;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getLanguage()
    {
        if (!$this->language) {
            return null;
        }

        return StreamOptions::LANGUAGE . '=' . $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function language(string $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getOutputFormat()
    {
        if (!$this->output_format) {
            return null;
        }

        return StreamOptions::OUTPUT_FORMAT . '=' . $this->output_format;
    }

    /**
     * @param string $output_format
     * @return $this
     */
    public function outputFormat(string $output_format)
    {
        $this->output_format = $output_format;
        return $this;
    }

    /**
     * @return string
     */
    protected function __getTrickPlayFactor()
    {
        if (!$this->trick_play_factor) {
            return null;
        }

        return StreamOptions::TRICK_PLAY_FACTOR . '=' . $this->trick_play_factor;
    }

    /**
     * @param string $trick_play_factor
     * @return $this
     */
    public function trickPlayFactor(string $trick_play_factor)
    {
        $this->trick_play_factor = $trick_play_factor;
        return $this;
    }
}