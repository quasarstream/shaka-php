<?php

/**
=========================================================
pre-generated PSSH
=========================================================
The example below use the H264 streams created in Media Encoding.
*/

use Shaka\Options\Streams\DRMStream;

require_once '../../init.require.php';

$stream1 = DRMStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio.mp4')
    ->drmLabel('AUDIO');

$stream2 = DRMStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'h264_360p.mp4')
    ->drmLabel('SD');

$stream3 = DRMStream::input($h264_main_480p)
    ->streamSelector('video')
    ->output($output_path . 'h264_480p.mp4')
    ->drmLabel('SD');

$stream4 = DRMStream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p.mp4')
    ->drmLabel('HD');

$stream5 = DRMStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->output($output_path . 'h264_1080p.mp4')
    ->drmLabel('HD');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->DRM('raw', function ($options) {
        return $options->keys(file_get_contents('raw.key'))
            ->pssh('000000317073736800000000EDEF8BA979D64ACEA3C827DCD51D21ED00000011220F7465737420636F6E74656E74206964');
    })
    ->HLS($output_path . 'h264_master.m3u8')
    ->DASH($output_path . 'h264.mpd')
    ->export();

echo $export;