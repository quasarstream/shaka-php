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
    exit("Please install the package via composer.\nRun the following command:\ncomposer install");
}

require_once $autoload_path;

$input_path = '/var/www/media/inputs/';
$output_path = '/var/www/media/outputs/';

$input_text = $input_path . 'subtitle.vtt';
$h264_baseline_360p = $input_path . 'video_360p.mp4';
$h264_main_480p = $input_path . 'video_480p.mp4';
$h264_main_720p = $input_path . 'video_720p.mp4';
$h264_high_1080p = $input_path . 'video_1080p.mp4';