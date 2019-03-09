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


use Shaka\Options\Streams\DASHStream;

class DASHTest extends TestCase
{
    public function testOnDemand()
    {
        list($audio, $text, $video) = $this->getOnDemandStream();

        $output = $this->getShaka()
            ->streams($audio, $text, $video)
            ->mediaPackaging()
            ->DASH($this->src_dir . '/dash_on_demand/h264.mpd')
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/dash_on_demand/audio.mp4');
        $this->assertFileExists($this->src_dir . '/dash_on_demand/output_text.vtt');
        $this->assertFileExists($this->src_dir . '/dash_on_demand/video.mp4');
        $this->assertFileExists($this->src_dir . '/dash_on_demand/h264.mpd');


        $this->deleteDirectory($this->src_dir . '/dash_on_demand');
    }

    public function testStaticLive()
    {
        list($audio, $text, $video) = $this->getStaticLiveStream();

        $output = $this->getShaka()
            ->streams($audio, $text, $video)
            ->mediaPackaging()
            ->DASH($this->src_dir . '/dash_static_live/h264.mpd', function ($options) {
                return $options->generateStaticMpd();
            })
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/dash_static_live/audio/init.mp4');
        $this->assertFileExists($this->src_dir . '/dash_static_live/text/init.mp4');
        $this->assertFileExists($this->src_dir . '/dash_static_live/h264_360p/init.mp4');
        $this->assertFileExists($this->src_dir . '/dash_static_live/h264.mpd');


        $this->deleteDirectory($this->src_dir . '/dash_static_live');
    }

    private function getOnDemandStream()
    {
        $audio = $this->getAudioStream()->output($this->src_dir . '/dash_on_demand/audio.mp4');
        $text = $this->getTextStream()->output($this->src_dir . '/dash_on_demand/output_text.vtt');
        $video = $this->getVideoStream()->output($this->src_dir . '/dash_on_demand/video.mp4');

        return [$audio, $text, $video];
    }

    private function getStaticLiveStream()
    {
        $audio = $this->getAudioStream()    ->initSegment($this->src_dir . '/dash_static_live/audio/init.mp4')
            ->segmentTemplate($this->src_dir . '/dash_static_live/audio/$Number$.m4s');
        $text = $this->getTextStream()->initSegment($this->src_dir . '/dash_static_live/text/init.mp4')
            ->segmentTemplate($this->src_dir . '/dash_static_live/text/$Number$.m4s');
        $video = $this->getVideoStream()->initSegment($this->src_dir . '/dash_static_live/h264_360p/init.mp4')
            ->segmentTemplate($this->src_dir . '/dash_static_live/h264_360p/$Number$.m4s');

        return [$audio, $text, $video];
    }

    private function getAudioStream()
    {
        return $this->getDASHStream()->streamSelector('audio');
    }

    private function getTextStream()
    {
        return DASHStream::input($this->src_dir . '/test.vtt')->streamSelector('text');
    }

    private function getVideoStream()
    {
        return $this->getDASHStream()->streamSelector('video');
    }
}
