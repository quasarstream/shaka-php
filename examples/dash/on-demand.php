<?php

/**
=========================================================
on-demand
=========================================================
The example below uses the H264 streams created in Media Encoding.
It can be applied to VP9 in the same way.

The below example creates five single track fragmented mp4
streams (4 video, 1 audio), a subtitle file and a manifest, which
describes the streams.
*/

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';

$stream1 = DASHStream::input($base_path . 'test.mp4')
    ->streamSelector('audio')
    ->output($base_path . 'audio.mp4');

$stream2 = DASHStream::input($base_path . 'test.vtt')
    ->streamSelector('text')
    ->output($base_path . 'output_text.vtt');

$stream3 = DASHStream::input($base_path . 'test.mp4')
    ->streamSelector('video')
    ->output($base_path . 'h264_360p.mp4');

$stream4 = DASHStream::input($base_path . 'test2.mp4')
    ->streamSelector('video')
    ->output($base_path . 'h264_480p.mp4 ');

$stream5 = DASHStream::input($base_path . 'test3.mp4')
    ->streamSelector('video')
    ->output($base_path . 'h264_720p.mp4');

$stream6 = DASHStream::input($base_path . 'test4.mp4')
    ->streamSelector('video')
    ->output($base_path . 'h264_1080p.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($base_path . 'h264.mpd')
    ->export();

echo $export;