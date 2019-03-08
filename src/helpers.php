<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('shaka')) {
    /**
     * get an instance of Shaka object
     *
     * @param string|null $binary
     * @return mixed
     * @throws \Shaka\Exception\ProcessException
     */
    function shaka(string $binary = null)
    {
        return \Shaka\Shaka::initialize($binary);
    }
}

if (!function_exists('stream')) {
    /**
     * get an instance of Stream object
     *
     * @param string $input
     * @return mixed
     */
    function stream(string $input)
    {
        return \Shaka\Options\Streams\Stream::input($input);
    }
}

if (!function_exists('dash_stream')) {
    /**
     * get an instance of DASHStream object
     *
     * @param string $input
     * @return mixed
     */
    function dash_stream(string $input)
    {
        return \Shaka\Options\Streams\DASHStream::input($input);
    }
}

if (!function_exists('hls_stream')) {
    /**
     * get an instance of HLSStream object
     *
     * @param string $input
     * @return mixed
     */
    function hls_stream(string $input)
    {
        return \Shaka\Options\Streams\HLSStream::input($input);
    }
}

if (!function_exists('drm_stream')) {
    /**
     * get an instance of DRMStream object
     *
     * @param string $input
     * @return mixed
     */
    function drm_stream(string $input)
    {
        return \Shaka\Options\Streams\DRMStream::input($input);
    }
}