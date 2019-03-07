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

$base_path = 'the/path/to/the/source/directory/';