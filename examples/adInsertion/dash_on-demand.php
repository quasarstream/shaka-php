<?php

/**
 * =========================================================
 * on-demand + ad
 * =========================================================
 * The example below uses the H264 streams created in Media Encoding.
 * It can be applied to VP9 in the same way.
 * The below example creates five single track fragmented mp4
 * streams (4 video, 1 audio), a subtitle file and a manifest, which
 * describes the streams.
 */

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';

$stream1 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio.mp4');

$stream2 = DASHStream::input($input_text)
    ->streamSelector('text')
    ->output($output_path . 'output_text.vtt');

$stream3 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'h264_360p.mp4');

$stream4 = DASHStream::input($h264_main_480p)
    ->streamSelector('video')
    ->output($output_path . 'h264_480p.mp4');

$stream5 = DASHStream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p.mp4');

$stream6 = DASHStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->output($output_path . 'h264_1080p.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($output_path . 'h264.mpd', function ($options){
        return $options->adCues('600;1800;3000');
    })
    ->export();

echo $export;