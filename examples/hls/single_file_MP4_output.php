<?php

/**
=========================================================
Single file MP4 output
=========================================================
The example below creates five single file MP4
streams and HLS playlists, which describe the streams
*/

use Shaka\Options\Streams\HLSStream;

require_once '../init.require.php';

$stream1 = HLSStream::input( $h264_baseline_360p)
    ->streamSelector('audio')
    ->output( $output_path . 'audio.mp4')
    ->playlistName('audio.m3u8')
    ->HLSGroupId('audio')
    ->HLSName('ENGLISH');

$stream2 = HLSStream::input( $h264_baseline_360p)
    ->streamSelector('video')
    ->output( $output_path . 'h264_360p.mp4')
    ->playlistName('h264_360p.m3u8');

$stream3 = HLSStream::input( $h264_main_480p)
    ->streamSelector('video')
    ->output( $output_path . 'h264_480p.mp4')
    ->playlistName('h264_480p.m3u8');

$stream4 = HLSStream::nput( $h264_main_720p)
    ->streamSelector('video')
    ->output( $output_path . 'h264_720p.mp4')
    ->playlistName('h264_720p.m3u8');

$stream5 = HLSStream::input( $h264_high_1080p)
    ->streamSelector('video')
    ->output( $output_path . 'h264_1080p.mp4')
    ->playlistName('h264_1080p.m3u8');

$export =\Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->HLS($output_path . 'h264_master.m3u8')
    ->export();

echo $export;