<?php

/**
 * =========================================================
 * on-demand with trick-play tracks
 * =========================================================
 * The example below creates two extra trick play tracks,
 * besides the files genereated with the on-demand example.
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

$stream4 = DASHStream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p.mp4');

$stream5 = DASHStream::input($h264_main_480p)
    ->streamSelector('video')
    ->trickPlayFactor(1)
    ->output($output_path . 'h264_480p.mp4');

$stream6 = DASHStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->trickPlayFactor(1)
    ->output($output_path . 'h264_1080p.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($output_path . 'h264.mpd')
    ->export();

echo $export;