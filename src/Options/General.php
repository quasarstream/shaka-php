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
    protected function getTimeShiftBufferDepth()
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
    public function setTimeShiftBufferDepth(string $time_shift_buffer_depth)
    {
        $this->time_shift_buffer_depth = $time_shift_buffer_depth;
        return $this;
    }

    /**
     * @return array
     */
    protected function getPreservedSegmentsOutsideLiveWindow()
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
    public function setPreservedSegmentsOutsideLiveWindow(string $preserved_segments_outside_live_window)
    {
        $this->preserved_segments_outside_live_window = $preserved_segments_outside_live_window;
        return $this;
    }

    /**
     * @return array
     */
    protected function getDefaultLanguage()
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
    public function setDefaultLanguage(string $default_language)
    {
        $this->default_language = $default_language;
        return $this;
    }

    /**
     * @return array
     */
    protected function getDefaultTextLanguage()
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
    public function setDefaultTextLanguage(string $default_text_language)
    {
        $this->default_text_language = $default_text_language;
        return $this;
    }
}