<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Tests\Shaka;


use PHPUnit\Framework\TestCase as BaseTestCase;
use Shaka\Options\Streams\DASHStream;
use Shaka\Options\Streams\DRMStream;
use Shaka\Options\Streams\HLSStream;
use Shaka\Options\Streams\Stream;
use Shaka\Shaka;

class TestCase extends BaseTestCase
{
    protected $src_dir;

    public function setUp()
    {
        $this->src_dir = __DIR__ . '/files';
    }

    protected function getShaka(): Shaka
    {
        return Shaka::initialize();
    }

    protected function getStream(): Stream
    {
        return Stream::input($this->src_dir . '/h264_baseline_360p.mp4');
    }

    protected function getDASHStream(): DASHStream
    {
        return DASHStream::input($this->src_dir . '/h264_baseline_360p.mp4');
    }

    protected function getHLSStream(): HLSStream
    {
        return HLSStream::input($this->src_dir . '/h264_baseline_360p.mp4');
    }

    protected function getDRMStream():DRMStream
    {
        return DRMStream::input($this->src_dir . '/h264_baseline_360p.mp4');
    }

    protected function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return @unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return @rmdir($dir);
    }
}
