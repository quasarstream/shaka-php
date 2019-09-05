<?php

/**
 * =========================================================
 * Single file MP4 output
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
    ->segmentTemplate($output_path . 'audio/$Number$.aac')
    ->playlistName('audio/main.m3u8')
    ->HLSGroupId('audio')
    ->HLSName('ENGLISH');

$stream2 = HLSStream::input($input_text)
    ->streamSelector('text')
    ->segmentTemplate($output_path . 'text/$Number$.vtt')
    ->playlistName('text/main.m3u8')
    ->HLSGroupId('text')
    ->HLSName('ENGLISH');

$stream3 = HLSStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_360p/$Number$.ts')
    ->playlistName('h264_360p/main.m3u8')
    ->iframeplaylistName('h264_360p/iframe.m3u8');

$stream4 = HLSStream::input($h264_main_480p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_480p/$Number$.ts')
    ->playlistName('h264_480p/main.m3u8')
    ->iframeplaylistName('h264_480p/iframe.m3u8');

$stream5 = HLSStream::input($h264_main_720p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_720p/$Number$.ts')
    ->playlistName('h264_720p/main.m3u8')
    ->iframeplaylistName('h264_720p/iframe.m3u8');

$stream6 = HLSStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->segmentTemplate($output_path . 'h264_1080p/$Number$.ts')
    ->playlistName('h264_1080p/main.m3u8')
    ->iframeplaylistName('h264_1080p/iframe.m3u8');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->HLS($output_path . 'h264_master.m3u8')
    ->export();

echo $export;