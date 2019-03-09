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


use Shaka\Options\Streams\HLSStream;

class HLSTest extends TestCase
{
    public function testMP4Output()
    {
        list($audio, $text, $video) = $this->getMP4OutputStream();

        $output = $this->getShaka()
            ->streams($audio, $text, $video)
            ->mediaPackaging()
            ->HLS($this->src_dir . '/hls_mp4_output/h264_master.m3u8')
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/hls_mp4_output/audio/init.mp4');
        $this->assertFileExists($this->src_dir . '/hls_mp4_output/h264_360p/init.mp4');
        $this->assertFileExists($this->src_dir . '/hls_mp4_output/h264_master.m3u8');


        $this->deleteDirectory($this->src_dir . '/hls_mp4_output');
    }

    public function testTSOutput()
    {
        list($audio, $text, $video) = $this->getTSOutputStream();

        $output = $this->getShaka()
            ->streams($audio, $text, $video)
            ->mediaPackaging()
            ->HLS($this->src_dir . '/hls_ts_output/h264_master.m3u8')
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/hls_ts_output/audio/main.m3u8');
        $this->assertFileExists($this->src_dir . '/hls_ts_output/h264_360p/main.m3u8');
        $this->assertFileExists($this->src_dir . '/hls_ts_output/h264_master.m3u8');


        $this->deleteDirectory($this->src_dir . '/hls_ts_output');
    }

    private function getMP4OutputStream()
    {
        $audio = $this->getAudioStream()->initSegment($this->src_dir . '/hls_mp4_output/audio/init.mp4')
            ->segmentTemplate($this->src_dir . '/hls_mp4_output/audio/$Number$.m4s')
            ->playlistName('audio/main.m3u8')
            ->HLSGroupId('audio')
            ->HLSName('ENGLISH');
        $text = $this->getTextStream()
            ->segmentTemplate($this->src_dir . '/hls_mp4_output/text/$Number$.vtt')
            ->playlistName('text/main.m3u8')
            ->HLSGroupId('text')
            ->HLSName('ENGLISH');
        $video = $this->getVideoStream()
            ->initSegment($this->src_dir . '/hls_mp4_output/h264_360p/init.mp4')
            ->segmentTemplate($this->src_dir . '/hls_mp4_output/h264_360p/$Number$.m4s')
            ->playlistName('h264_360p/main.m3u8')
            ->iframeplaylistName('h264_360p/iframe.m3u8');

        return [$audio, $text, $video];
    }

    private function getTSOutputStream()
    {
        $audio = $this->getAudioStream()->segmentTemplate($this->src_dir . '/hls_ts_output/audio/$Number$.aac')
            ->playlistName('audio/main.m3u8')
            ->HLSGroupId('audio')
            ->HLSName('ENGLISH');
        $text = $this->getTextStream()->segmentTemplate($this->src_dir . '/hls_ts_output/text/$Number$.vtt')
            ->playlistName('text/main.m3u8')
            ->HLSGroupId('text')
            ->HLSName('ENGLISH');
        $video = $this->getVideoStream()->segmentTemplate($this->src_dir . '/hls_ts_output/h264_360p/$Number$.ts')
            ->playlistName('h264_360p/main.m3u8')
            ->iframeplaylistName('h264_360p/iframe.m3u8');

        return [$audio, $text, $video];
    }

    private function getAudioStream()
    {
        return $this->getHLSStream()->streamSelector('audio');
    }

    private function getTextStream()
    {
        return HLSStream::input($this->src_dir . '/test.vtt')->streamSelector('text');
    }

    private function getVideoStream()
    {
        return $this->getHLSStream()->streamSelector('video');
    }
}
