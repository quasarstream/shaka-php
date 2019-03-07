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

$stream1 = HLSStream::input( $base_path . 'test.mp4')
    ->streamSelector('audio')
    ->output( $base_path . 'audio.mp4')
    ->playlistName('audio.m3u8')
    ->HLSGroupId('audio')
    ->HLSName('ENGLISH');

$stream2 = HLSStream::input( $base_path . 'test.mp4')
    ->streamSelector('video')
    ->output( $base_path . 'h264_360p.mp4')
    ->playlistName('h264_360p.m3u8');

$stream3 = HLSStream::input( $base_path . 'test2.mp4')
    ->streamSelector('video')
    ->output( $base_path . 'h264_480p.mp4')
    ->playlistName('h264_480p.m3u8');

$stream4 = HLSStream::nput( $base_path . 'test3.mp4')
    ->streamSelector('video')
    ->output( $base_path . 'h264_720p.mp4')
    ->playlistName('h264_720p.m3u8');

$stream5 = HLSStream::input( $base_path . 'test4.mp4')
    ->streamSelector('video')
    ->output( $base_path . 'h264_1080p.mp4')
    ->playlistName('h264_1080p.m3u8');

$export =\Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->HLS($base_path . 'h264_master.m3u8')
    ->export();

echo $export;