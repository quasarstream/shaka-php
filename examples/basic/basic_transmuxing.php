<?php

/**
=========================================================
Basic transmuxing
=========================================================
Shaka Packager can be used to extract streams, optionally
transmuxes the streams from one container format to another
container format.

Here is a simple example that extracts video and audio from
the input file
*/

use Shaka\Options\Streams\Stream;

require_once '../init.require.php';

$stream1 = Stream::input($base_path . 'test.mp4')
    ->streamSelector('video')
    ->output($base_path . 'video.mp4');

$stream2 = Stream::input($base_path . 'test.mp4')
    ->streamSelector('audio')
    ->output($base_path . 'audio.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2)
    ->mediaPackaging()
    ->export();

echo $export;