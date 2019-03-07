<?php

/**
=========================================================
‘cbcs’ protection scheme
=========================================================
The example below use the H264 streams created in Media Encoding.
*/

use Shaka\Options\Streams\Stream;

require_once '../../init.require.php';

$stream1 = Stream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio.mp4');

$stream2 = Stream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'h264_360p.mp4');

$stream3 = Stream::input($h264_main_480p)
    ->streamSelector('video')
    ->output($output_path . 'h264_480p.mp4');

$stream4 = Stream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p.mp4');

$stream5 = Stream::input($h264_high_1080p)
    ->streamSelector('video')
    ->output($output_path . 'h264_1080p.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->DRM('raw', function ($options) {
        return $options->protectionScheme('cbcs')
            ->keys(file_get_contents('raw.key'))
            ->protectionSystems('FairPlay')
            ->iv('11223344556677889900112233445566');
    })
    ->HLS($output_path . 'h264_master.m3u8', function ($options) {
        return $options->HLSKeyUri('skd://testAssetID');
    })
    ->export();

echo $export;