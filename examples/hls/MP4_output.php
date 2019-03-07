<?php

/**
=========================================================
MP4 output
=========================================================
The example below creates five single track TS streams
(4 video, 1 audio) and HLS playlists, which describe the streams.
*/

use Shaka\Options\Streams\HLSStream;

require_once '../init.require.php';

$stream1 = HLSStream::input( $base_path . 'test.mp4')
    ->streamSelector('audio')
    ->initSegment( $base_path . 'audio/init.mp4')
    ->segmentTemplate( $base_path . 'audio/$Number$.m4s')
    ->playlistName('audio/main.m3u8')
    ->HLSGroupId('audio')
    ->HLSName('ENGLISH');

$stream2 = HLSStream::input( $base_path . 'test.vtt')
    ->streamSelector('text')
    ->segmentTemplate( $base_path . 'text/$Number$.vtt')
    ->playlistName('text/main.m3u8')
    ->HLSGroupId('text')
    ->HLSName('ENGLISH');

$stream3 = HLSStream::input( $base_path . 'test.mp4')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_360p/init.mp4')
    ->segmentTemplate( $base_path . 'h264_360p/$Number$.m4s')
    ->playlistName('h264_360p/main.m3u8')
    ->iframeplaylistName('h264_360p/iframe.m3u8');

$stream4 = HLSStream::input( $base_path . 'test2.mp4')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_480p/init.mp4')
    ->segmentTemplate( $base_path . 'h264_480p/$Number$.m4s')
    ->playlistName('h264_480p/main.m3u8')
    ->iframeplaylistName('h264_480p/iframe.m3u8');

$stream5 = HLSStream::input( $base_path . 'test3.mp4')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_720p/init.mp4')
    ->segmentTemplate( $base_path . 'h264_720p/$Number$.m4s')
    ->playlistName('h264_720p/main.m3u8')
    ->iframeplaylistName('h264_720p/iframe.m3u8');

$stream6 = HLSStream::input( $base_path . 'test4.mp4')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_1080p/init.mp4')
    ->segmentTemplate( $base_path . 'h264_1080p/$Number$.m4s')
    ->playlistName('h264_1080p/main.m3u8')
    ->iframeplaylistName('h264_1080p/iframe.m3u8');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->HLS($base_path . 'h264_master.m3u8')
    ->export();

echo $export;