<?php

/**
=========================================================
Media file analysis
=========================================================
Shaka Packager can be used to inspect the content of a
media file and dump basic stream information
*/

use Shaka\Options\Streams\Stream;

require_once '../init.require.php';

$export = \Shaka\Shaka::initialize()
    ->streams(Stream::input($h264_baseline_360p))
    ->mediaFileAnalysis()
    ->export();

echo $export->first()->get('width');

foreach ($export->all() as $num => $stream){
    echo "\n\n\nStream $num\n";
    echo "------------------\n";
    foreach ($stream->all() as $attr => $value){
        echo $attr . ": " . $value . "\n";
    }
}