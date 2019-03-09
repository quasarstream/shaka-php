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


use Shaka\Media\Media;

class TransmuxingTest extends TestCase
{
    public function testMediaClass()
    {
        $this->assertInstanceOf(Media::class, $this->getShaka()->streams($this->getStream())->mediaPackaging());
    }

    public function testTransmuxing()
    {
        $output = $this->getShaka()->streams($this->getStream1(), $this->getStream2())->mediaPackaging()->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/transmuxing/video.mp4');
        $this->assertFileExists($this->src_dir . '/transmuxing/audio.mp4');


        $this->deleteDirectory($this->src_dir . '/transmuxing');
    }

    private function getStream1()
    {
        return $this->getStream()->streamSelector('video')->output($this->src_dir . '/transmuxing/video.mp4');
    }

    private function getStream2()
    {
        return $this->getStream()->streamSelector('audio')->output($this->src_dir . '/transmuxing/audio.mp4');
    }

}