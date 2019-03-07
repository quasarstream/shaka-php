<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$autoload_path = __DIR__ . '/../vendor/autoload.php';

if(!is_file($autoload_path)){
    exit('please install the package via composer.');
}

require_once $autoload_path;

$input_path = 'c:\test\\'; //'the/path/to/the/source/directory/'
$output_path = 'c:\test\\'; //'the/path/to/the/destination/directory/'

$input_text = $input_path . 'test.vtt';
$h264_baseline_360p = $input_path . 'test.mp4';
$h264_main_480p = $input_path . 'test2.mp4';
$h264_main_720p = $input_path . 'test3.mp4';
$h264_high_1080p = $input_path . 'test4.mp4';