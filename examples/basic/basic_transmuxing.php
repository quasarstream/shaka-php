<?php

/**
 * =========================================================
 * Basic transmuxing
 * =========================================================
 * Shaka Packager can be used to extract streams, optionally
 * transmuxes the streams from one container format to another
 * container format.
 *
 * Here is a simple example that extracts video and audio from
 * the input file
*/

use Shaka\Options\Streams\Stream;

require_once '../init.require.php';

$stream1 = Stream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'video.mp4');

$stream2 = Stream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2)
    ->mediaPackaging()
    ->export();

echo $export;