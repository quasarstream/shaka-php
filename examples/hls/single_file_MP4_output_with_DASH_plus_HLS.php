<?php

/**
=========================================================
Single file MP4 output with DASH + HLS
=========================================================
The example below creates five single file MP4 streams,
and HLS playlists as well as DASH manifests.
*/

use Shaka\Options\Streams\HLSStream;

require_once '../init.require.php';

$stream1 = HLSStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio.mp4')
    ->playlistName('audio.m3u8')
    ->HLSGroupId('audio')
    ->HlsName('ENGLISH');

$stream2 = HLSStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'h264_360p.mp4')
    ->playlistName('h264_360p.m3u8')
    ->iframeplaylistName('h264_360p_iframe.m3u8');

$stream3 = HLSStream::input($h264_main_480p)
    ->streamSelector('video')
    ->output($output_path . 'h264_480p.mp4')
    ->playlistName('h264_480p.m3u8')
    ->iframeplaylistName('h264_480p_iframe.m3u8');

$stream4 = HLSStream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p.mp4')
    ->playlistName('h264_720p.m3u8')
    ->iframeplaylistName('h264_720p_iframe.m3u8');

$stream5 = HLSStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->output($output_path . 'h264_1080p.mp4')
    ->playlistName('h264_1080p.m3u8')
    ->iframeplaylistName('h264_1080p_iframe.m3u8');


$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->HLS($output_path . 'h264_master.m3u8')
    ->DASH($output_path . 'h264.mpd')
    ->export();

echo $export;