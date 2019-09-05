<?php

/**
 * =========================================================
 * DASH Live
 * =========================================================
 * The example is similar to the on-demand, see DASH example.
*/

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';

$stream1 = DASHStream::input('udp://225.1.1.8:8001?interface=172.29.46.122')
    ->streamSelector('audio')
    ->initSegment($output_path . 'audio_init.mp4')
    ->segmentTemplate($output_path . 'audio_$Number$.m4s');

$stream2 = DASHStream::input('udp://225.1.1.8:8001?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_360p_init.mp4')
    ->segmentTemplate($output_path . 'h264_360p_$Number$.m4s');

$stream3 = DASHStream::input('udp://225.1.1.8:8002?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_480p_init.mp4')
    ->segmentTemplate($output_path . 'h264_480p_$Number$.m4s');

$stream4 = DASHStream::input('udp://225.1.1.8:8003?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_720p_init.mp4')
    ->segmentTemplate($output_path . 'h264_720p_$Number$.m4s');

$stream5 = DASHStream::input('udp://225.1.1.8:8004?interface=172.29.46.122')
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_1080p_init.mp4')
    ->segmentTemplate($output_path . 'h264_1080p_$Number$.m4s');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5)
    ->mediaPackaging()
    ->DASH($output_path . 'h264.mpd')
    ->export();

echo $export;