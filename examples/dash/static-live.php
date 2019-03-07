<?php

/**
=========================================================
static-live
=========================================================
The example below creates five groups of segments
(each with an init segment and a series of media segments)
for the five streams and a manifest, which describes the streams.
*/

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';

$stream1 = DASHStream::input($base_path . 'test.mp4')
    ->streamSelector('audio')
    ->initSegment($base_path . 'audio\init.mp4')
    ->segmentTemplate($base_path . 'audio\$Number$.m4s');

$stream2 = DASHStream::input($base_path . 'test.vtt')
    ->streamSelector('text')
    ->initSegment($base_path . 'text\init.mp4')
    ->segmentTemplate($base_path . 'text\$Number$.m4s');

$stream3 = DASHStream::input($base_path . 'test.mp4')
    ->streamSelector('video')
    ->initSegment($base_path . 'h264_360p\init.mp4')
    ->segmentTemplate($base_path . 'h264_360p\$Number$.m4s');

$stream4 = DASHStream::input($base_path . 'test2.mp4')
    ->streamSelector('video')
    ->initSegment($base_path . 'h264_480p\init.mp4')
    ->segmentTemplate($base_path . 'h264_480p\$Number$.m4s');

$stream5 = DASHStream::input($base_path . 'test3.mp4')
    ->streamSelector('video')
    ->initSegment($base_path . 'h264_720p\init.mp4')
    ->segmentTemplate($base_path . 'h264_720p\$Number$.m4s');

$stream6 = DASHStream::input($base_path . 'test4.mp4')
    ->streamSelector('video')
    ->initSegment($base_path . 'h264_1080p\init.mp4')
    ->segmentTemplate($base_path . 'h264_1080p\$Number$.m4s');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($base_path . 'h264.mpd', function ($options) {
        return $options->generateStaticMpd();
    })
    ->export();

echo $export;