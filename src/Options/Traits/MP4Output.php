<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Traits;


use Shaka\Options\MediaOptions;

trait MP4Output
{
    /** @var bool*/
    private $mp4_include_pssh_in_stream;

    /** @var bool*/
    private $generate_sidx_in_media_segments;

    /** @var bool*/
    private $nogenerate_sidx_in_media_segments;

    /** @var bool*/
    private $transport_stream_timestamp_offset_ms;

    /**
     * @return array
     */
    protected function __getMp4IncludePsshInStream()
    {
        if (!$this->mp4_include_pssh_in_stream) {
            return null;
        }

        return [MediaOptions::MP4_INCLUDE_PSSH_IN_STREAM];
    }

    /**
     * @param bool $mp4_include_pssh_in_stream
     * @return MP4Output
     */
    public function Mp4IncludePsshInStream(bool $mp4_include_pssh_in_stream)
    {
        $this->mp4_include_pssh_in_stream = $mp4_include_pssh_in_stream;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getGenerateSidxInMediaSegments()
    {
        if (!$this->generate_sidx_in_media_segments) {
            return null;
        }

        return [MediaOptions::GENERATE_SIDX_IN_MEDIA_SEGMENTS];
    }

    /**
     * @param bool $generate_sidx_in_media_segments
     * @return MP4Output
     */
    public function generateSidxInMediaSegments(bool $generate_sidx_in_media_segments)
    {
        $this->generate_sidx_in_media_segments = $generate_sidx_in_media_segments;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getNogenerateSidxInMediaSegments()
    {
        if (!$this->nogenerate_sidx_in_media_segments) {
            return null;
        }

        return [MediaOptions::NOGENERATE_SIDX_IN_MEDIA_SEGMENTS];
    }

    /**
     * @param bool $nogenerate_sidx_in_media_segments
     * @return MP4Output
     */
    public function nogenerateSidxInMediaSegments(bool $nogenerate_sidx_in_media_segments)
    {
        $this->nogenerate_sidx_in_media_segments = $nogenerate_sidx_in_media_segments;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getTransportStreamTimestampOffsetMs()
    {
        if (!$this->transport_stream_timestamp_offset_ms) {
            return null;
        }

        return [MediaOptions::TRANSPORT_STREAM_TIMESTAMP_OFFSET_MS];
    }

    /**
     * @param bool $transport_stream_timestamp_offset_ms
     * @return MP4Output
     */
    public function transportStreamTimestampOffsetMs(bool $transport_stream_timestamp_offset_ms)
    {
        $this->transport_stream_timestamp_offset_ms = $transport_stream_timestamp_offset_ms;
        return $this;
    }
    
    
    
}