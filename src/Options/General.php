<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options;


use Shaka\Options\Traits\Chunking;
use Shaka\Options\Traits\AdInsertion;
use Shaka\Options\Traits\MP4Output;

class General extends ExportOptions
{
    use AdInsertion, Chunking, MP4Output;

    /** @var string */
    private $time_shift_buffer_depth;

    /** @var string */
    private $preserved_segments_outside_live_window;

    /** @var string */
    private $default_language;

    /** @var string */
    private $default_text_language;

    /**
     * @return array
     */
    protected function __getTimeShiftBufferDepth()
    {
        if (!$this->time_shift_buffer_depth) {
            return null;
        }

        return [MediaOptions::TIME_SHIFT_BUFFER_DEPTH, $this->time_shift_buffer_depth];
    }

    /**
     * @param string $time_shift_buffer_depth
     * @return $this
     */
    public function timeShiftBufferDepth(string $time_shift_buffer_depth)
    {
        $this->time_shift_buffer_depth = $time_shift_buffer_depth;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getPreservedSegmentsOutsideLiveWindow()
    {
        if (!$this->preserved_segments_outside_live_window) {
            return null;
        }

        return [MediaOptions::PRESERVED_SEGMENTS_OUTSIDE_LIVE_WINDOW, $this->preserved_segments_outside_live_window];
    }

    /**
     * @param string $preserved_segments_outside_live_window
     * @return $this
     */
    public function preservedSegmentsOutsideLiveWindow(string $preserved_segments_outside_live_window)
    {
        $this->preserved_segments_outside_live_window = $preserved_segments_outside_live_window;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getDefaultLanguage()
    {
        if (!$this->default_language) {
            return null;
        }

        return [MediaOptions::DEFAULT_LANGUAGE, $this->default_language];
    }

    /**
     * @param string $default_language
     * @return $this
     */
    public function defaultLanguage(string $default_language)
    {
        $this->default_language = $default_language;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getDefaultTextLanguage()
    {
        if (!$this->default_text_language) {
            return null;
        }

        return [MediaOptions::DEFAULT_TEXT_LANGUAGE, $this->default_text_language];
    }

    /**
     * @param string $default_text_language
     * @return $this
     */
    public function defaultTextLanguage(string $default_text_language)
    {
        $this->default_text_language = $default_text_language;
        return $this;
    }
}