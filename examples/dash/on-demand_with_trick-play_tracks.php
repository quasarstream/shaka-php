<?php

/**
=========================================================
on-demand with trick-play tracks
=========================================================
The example below creates two extra trick play tracks,
besides the files genereated with the on-demand example.
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

$stream4 = DASHStream::input($base_path . 'test3.mp4')
    ->streamSelector('video')
    ->output($base_path . 'h264_720p.mp4');

$stream5 = DASHStream::input($base_path . 'test2.mp4')
    ->streamSelector('video')
    ->trickPlayFactor(1)
    ->output($base_path . 'h264_480p.mp4 ');

$stream6 = DASHStream::input($base_path . 'test4.mp4')
    ->streamSelector('video')
    ->trickPlayFactor(1)
    ->output($base_path . 'h264_1080p.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($base_path . 'h264.mpd')
    ->export();

echo $export;