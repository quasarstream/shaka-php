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


class DASH
{
    /** @var bool */
    private $generate_static_mpd;

    /** @var string */
    private $mpd_output;

    /** @var string */
    private $base_urls;

    /** @var string */
    private $min_buffer_time;

    /** @var string */
    private $minimum_update_period;

    /** @var string */
    private $suggested_presentation_delay;

    /** @var string */
    private $time_shift_buffer_depth;

    /** @var string */
    private $preserved_segments_outside_live_window;

    /** @var string */
    private $utc_timings;

    /** @var string */
    private $default_language;

    /** @var string */
    private $default_text_language;

    /**
     * @return bool
     */
    public function isGenerateStaticMpd(): bool
    {
        if(!$this->generate_static_mpd){
            return null;
        }

        return MediaOptions::GENERATE_STATIC_MPD;
    }

    /**
     * @param bool $generate_static_mpd
     * @return DASH
     */
    public function setGenerateStaticMpd(bool $generate_static_mpd = true): DASH
    {
        $this->generate_static_mpd = $generate_static_mpd;
        return $this;
    }

    /**
     * @return string
     */
    protected function getBaseUrls(): string
    {
        if(!$this->base_urls){
            return null;
        }

        return MediaOptions::BASE_URLS . "=" . $this->base_urls;
    }

    /**
     * @param string $base_urls
     * @return DASH
     */
    public function setBaseUrls(string $base_urls): DASH
    {
        $this->base_urls = $base_urls;
        return $this;
    }

    /**
     * @return string
     */
    protected function getMinBufferTime(): string
    {
        if(!$this->min_buffer_time){
            return null;
        }

        return MediaOptions::MIN_BUFFER_TIME . "=" . $this->min_buffer_time;
    }

    /**
     * @param string $min_buffer_time
     * @return DASH
     */
    public function setMinBufferTime(string $min_buffer_time): DASH
    {
        $this->min_buffer_time = $min_buffer_time;
        return $this;
    }

    /**
     * @return string
     */
    protected function getMinimumUpdatePeriod(): string
    {
        if(!$this->minimum_update_period){
            return null;
        }

        return MediaOptions::MINIMUM_UPDATE_PERIOD . "=" . $this->minimum_update_period;
    }

    /**
     * @param string $minimum_update_period
     * @return DASH
     */
    public function setMinimumUpdatePeriod(string $minimum_update_period): DASH
    {
        $this->minimum_update_period = $minimum_update_period;
        return $this;
    }

    /**
     * @return string
     */
    protected function getSuggestedPresentationDelay(): string
    {
        if(!$this->suggested_presentation_delay){
            return null;
        }

        return MediaOptions::SUGGESTED_PRESENTATION_DELAY . "=" . $this->suggested_presentation_delay;
    }

    /**
     * @param string $suggested_presentation_delay
     * @return DASH
     */
    public function setSuggestedPresentationDelay(string $suggested_presentation_delay): DASH
    {
        $this->suggested_presentation_delay = $suggested_presentation_delay;
        return $this;
    }

    /**
     * @return string
     */
    protected function getTimeShiftBufferDepth(): string
    {
        if(!$this->time_shift_buffer_depth){
            return null;
        }

        return MediaOptions::TIME_SHIFT_BUFFER_DEPTH . "=" . $this->time_shift_buffer_depth;
    }

    /**
     * @param string $time_shift_buffer_depth
     * @return DASH
     */
    public function setTimeShiftBufferDepth(string $time_shift_buffer_depth): DASH
    {
        $this->time_shift_buffer_depth = $time_shift_buffer_depth;
        return $this;
    }

    /**
     * @return string
     */
    protected function getPreservedSegmentsOutsideLiveWindow(): string
    {
        if(!$this->preserved_segments_outside_live_window){
            return null;
        }

        return MediaOptions::PRESERVED_SEGMENTS_OUTSIDE_LIVE_WINDOW . "=" . $this->preserved_segments_outside_live_window;
    }

    /**
     * @param string $preserved_segments_outside_live_window
     * @return DASH
     */
    public function setPreservedSegmentsOutsideLiveWindow(string $preserved_segments_outside_live_window): DASH
    {
        $this->preserved_segments_outside_live_window = $preserved_segments_outside_live_window;
        return $this;
    }

    /**
     * @return string
     */
    protected function getUtcTimings(): string
    {
        if(!$this->utc_timings){
            return null;
        }

        return MediaOptions::UTC_TIMINGS . "=" . $this->utc_timings;
    }

    /**
     * @param string $utc_timings
     * @return DASH
     */
    public function setUtcTimings(string $utc_timings): DASH
    {
        $this->utc_timings = $utc_timings;
        return $this;
    }

    /**
     * @return string
     */
    protected function getDefaultLanguage(): string
    {
        if(!$this->default_language){
            return null;
        }

        return MediaOptions::DEFAULT_LANGUAGE . "=" . $this->default_language;
    }

    /**
     * @param string $default_language
     * @return DASH
     */
    public function setDefaultLanguage(string $default_language): DASH
    {
        $this->default_language = $default_language;
        return $this;
    }

    /**
     * @return string
     */
    protected function getDefaultTextLanguage(): string
    {
        if(!$this->default_text_language){
            return null;
        }

        return MediaOptions::DEFAULT_TEXT_LANGUAGE . "=" . $this->default_text_language;
    }

    /**
     * @param string $default_text_language
     * @return DASH
     */
    public function setDefaultTextLanguage(string $default_text_language): DASH
    {
        $this->default_text_language = $default_text_language;
        return $this;
    }

    /**
     * @return mixed
     * @throws \Shaka\Exception\ProcessException
     */
    public function export()
    {
        if(!$this->mpd_output = func_get_arg(0)) {
            $this->mpd_output = __DIR__ . "/dash/output.mpd";
        }

        return $this->runCommand();
    }

    /**
     * void
     */
    protected function BuildCommand(): void
    {
        foreach ($this->streams as $stream) {
            $this->process->addCommand($stream->build());
        }

        $this->process->addCommand($this->options());

        $this->process->addCommand(MediaOptions::MPD_OUTPUT . "=" . $this->mpd_output);
    }
}