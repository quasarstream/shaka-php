<?php

/**
 * =========================================================
 * Single file MP4 output + ad
 * =========================================================
 * The example below uses the H264 streams created in Media Encoding.
 *
 * The example below creates five single track TS streams
 * (4 video, 1 audio) and HLS playlists, which describe the streams.
*/

use Shaka\Options\Streams\HLSStream;

require_once '../init.require.php';

$stream1 = HLSStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->segmentTemplate($output_path . 'audio/$Number$.aac');

$stream2 = HLSStream::input($input_text)
    ->streamSelector('text')
    ->segmentTemplate($output_path . 'text/$Number$.vtt');

$stream3 = HLSStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_360p/$Number$.ts');

$stream4 = HLSStream::input($h264_main_480p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_480p/$Number$.ts');

$stream5 = HLSStream::input($h264_main_720p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_720p/$Number$.ts');

$stream6 = HLSStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_1080p/$Number$.ts');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->HLS($output_path . 'h264_master.m3u8', function ($options){
        return $options->adCues('600;1800;3000');
    })
    ->export();

echo $export;