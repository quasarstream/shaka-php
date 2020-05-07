<?php

/**
 * =========================================================
 * static-live + ad
 * =========================================================
 * The example below creates five groups of segments
 * (each with an init segment and a series of media segments)
 * for the five streams and a manifest, which describes the streams.
*/

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';

$stream1 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->initSegment($output_path . 'audio/init.mp4')
    ->segmentTemplate($output_path . 'audio/$Number$.m4s');

$stream2 = DASHStream::input($input_text)
    ->streamSelector('text')
    ->initSegment($output_path . 'text/init.mp4')
    ->segmentTemplate($output_path . 'text/$Number$.m4s');

$stream3 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_360p/init.mp4')
    ->segmentTemplate($output_path . 'h264_360p/$Number$.m4s');

$stream4 = DASHStream::input($h264_main_480p)
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_480p/init.mp4')
    ->segmentTemplate($output_path . 'h264_480p/$Number$.m4s');

$stream5 = DASHStream::input($h264_main_720p)
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_720p/init.mp4')
    ->segmentTemplate($output_path . 'h264_720p/$Number$.m4s');

$stream6 = DASHStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->initSegment($output_path . 'h264_1080p/init.mp4')
    ->segmentTemplate($output_path . 'h264_1080p/$Number$.m4s');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($output_path . 'h264.mpd', function ($options) {
        return $options->generateStaticLiveMpd()
            ->adCues('600;1800;3000');
    })
    ->export();

echo $export;