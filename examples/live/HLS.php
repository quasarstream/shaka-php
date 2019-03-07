<?php

/**
=========================================================
HLS Live
=========================================================
The example is similar to the on-demand, see HLS example.
*/

use Shaka\Options\Streams\HLSStream;

require_once '../init.require.php';

$stream1 = HLSStream::input( 'udp://225.1.1.8:8001?interface=172.29.46.122')
    ->streamSelector('audio')
    ->initSegment( $base_path . 'audio_init.mp4')
    ->segmentTemplate( $base_path . 'audio_$Number$.m4s')
    ->playlistName('audio.m3u8')
    ->HLSGroupId('audio')
    ->HLSName('ENGLISH');

$stream2 = HLSStream::input( 'udp://225.1.1.8:8001?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_360p_init.mp4')
    ->segmentTemplate( $base_path . 'h264_360p_$Number$.m4s')
    ->playlistName('h264_360p.m3u8');

$stream3 = HLSStream::input( 'udp://225.1.1.8:8002?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_480p_init.mp4')
    ->segmentTemplate( $base_path . 'h264_480p_$Number$.m4s')
    ->playlistName('h264_480p.m3u8');

$stream4 = HLSStream::input( 'udp://225.1.1.8:8003?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_720p_init.mp4')
    ->segmentTemplate( $base_path . 'h264_720p_$Number$.m4s')
    ->playlistName('h264_720p.m3u8');

$stream5 = HLSStream::input( 'udp://225.1.1.8:8004?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment( $base_path . 'h264_1080p_init.mp4')
    ->segmentTemplate( $base_path . 'h264_1080p_$Number$.m4s')
    ->playlistName('h264_1080p.m3u8');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->HLS($base_path . 'h264_master.m3u8', function ($options) {
        return $options->HLSPlaylistType('LIVE');
    })
    ->export();

echo $export;