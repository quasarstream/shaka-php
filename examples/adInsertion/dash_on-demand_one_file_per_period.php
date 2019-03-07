<?php

/**
=========================================================
on-demand + one file per period + ad
=========================================================
The example below uses the H264 streams created in Media Encoding.
It can be applied to VP9 in the same way.

The below example creates five single track fragmented mp4
streams (4 video, 1 audio), a subtitle file and a manifest, which
describes the streams.
*/

use Shaka\Options\Streams\DASHStream;

require_once '../init.require.php';
/*
 *
 * 'in=h264_baseline_360p_600.mp4,stream=audio,output=audio_$Number$.mp4' \
  'in=input_text.vtt,stream=text,output=output_text_$Number$.mp4' \
  'in=h264_baseline_360p_600.mp4,stream=video,output=h264_360p_$Number$.mp4' \
  'in=h264_main_480p_1000.mp4,stream=video,output=h264_480p_$Number$.mp4' \
  'in=h264_main_720p_3000.mp4,stream=video,output=h264_720p_$Number$.mp4' \
  'in=h264_high_1080p_6000.mp4,stream=video,output=h264_1080p_$Number$.mp4' \
  --ad_cues 600;1800;3000 \
  --mpd_output h264.mpd
 * */
$stream1 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('audio')
    ->output($output_path . 'audio_$Number$.mp4');

$stream2 = DASHStream::input($input_text)
    ->streamSelector('text')
    ->output($output_path . 'output_text_$Number$.mp4');

$stream3 = DASHStream::input($h264_baseline_360p)
    ->streamSelector('video')
    ->output($output_path . 'h264_360p_$Number$.mp4');

$stream4 = DASHStream::input($h264_main_480p)
    ->streamSelector('video')
    ->output($output_path . 'h264_480p_$Number$.mp4');

$stream5 = DASHStream::input($h264_main_720p)
    ->streamSelector('video')
    ->output($output_path . 'h264_720p_$Number$.mp4');

$stream6 = DASHStream::input($h264_high_1080p)
    ->streamSelector('video')
    ->output($output_path . 'h264_1080p_$Number$.mp4');

$export = \Shaka\Shaka::initialize()
    ->streams($stream1, $stream2, $stream3, $stream4, $stream5, $stream6)
    ->mediaPackaging()
    ->DASH($output_path . 'h264.mpd', function ($options){
        return $options->adCues('600;1800;3000');
    })
    ->export();

echo $export;