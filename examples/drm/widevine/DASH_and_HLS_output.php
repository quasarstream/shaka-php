<?php

/**
=========================================================
DASH and HLS output
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
    ->DRM('widevine', function ($options) {
        return $options->keyServerUrl('https://license.uat.widevine.com/cenc/getcontentkey/widevine_test')
            ->contentId('7465737420636f6e74656e74206964')
            ->signer('widevine_test')
            ->aesSigningKey('1ae8ccd0e7985cc0b6203a55855a1034afc252980e970ca90e5202689f947ab9')
            ->aesSigningIv('d58ce954203b7c9a9a9d467f59839249');
    })
    ->HLS($output_path . 'h264_master.m3u8')
    ->DASH($output_path . 'h264.mpd')
    ->export();

echo $export;