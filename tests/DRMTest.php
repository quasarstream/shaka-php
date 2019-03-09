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


class DRMTest extends TestCase
{
    public function testCBCSProtection()
    {
        list($audio, $video) = $this->getCBCSProtectionStream();

        $output = $this->getShaka()
            ->streams($audio, $video)
            ->mediaPackaging()
            ->DRM('raw', function ($options) {
                return $options->protectionScheme('cbcs')
                    ->keys(file_get_contents($this->src_dir .'/raw.key'))
                    ->protectionSystems('FairPlay')
                    ->iv('11223344556677889900112233445566');
            })
            ->HLS($this->src_dir . '/drm_cbcs/h264_master.m3u8', function ($options) {
                return $options->HLSKeyUri('skd://testAssetID');
            })
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/drm_cbcs/audio.mp4');
        $this->assertFileExists($this->src_dir . '/drm_cbcs/video.mp4');
        $this->assertFileExists($this->src_dir . '/drm_cbcs/h264_master.m3u8');


        $this->deleteDirectory($this->src_dir . '/drm_cbcs');
    }
    public function testPSSHProtection()
    {
        list($audio, $video) = $this->getPreGeneratePSSHStream();

        $output = $this->getShaka()
            ->streams($audio, $video)
            ->mediaPackaging()
            ->DRM('raw', function ($options) {
                return $options->keys(file_get_contents($this->src_dir .'/raw.key'))
                    ->pssh('000000317073736800000000EDEF8BA979D64ACEA3C827DCD51D21ED00000011220F7465737420636F6E74656E74206964');
            })
            ->HLS($this->src_dir . '/drm_pssh/h264_master.m3u8')
            ->DASH($this->src_dir . '/drm_pssh/h264.mpd')
            ->export();

        $this->assertEquals('Packaging completed successfully.' . PHP_EOL, $output);
        $this->assertFileExists($this->src_dir . '/drm_pssh/audio.mp4');
        $this->assertFileExists($this->src_dir . '/drm_pssh/video.mp4');
        $this->assertFileExists($this->src_dir . '/drm_pssh/h264_master.m3u8');
        $this->assertFileExists($this->src_dir . '/drm_pssh/h264.mpd');


        $this->deleteDirectory($this->src_dir . '/drm_pssh');
    }

    private function getCBCSProtectionStream()
    {
        $audio = $this->getAudioStream()->output($this->src_dir . '/drm_cbcs/audio.mp4')
            ->drmLabel('AUDIO');
        $video = $this->getVideoStream()->output($this->src_dir . '/drm_cbcs/video.mp4')
            ->drmLabel('SD');

        return [$audio, $video];
    }

    private function getPreGeneratePSSHStream()
    {
        $audio = $this->getAudioStream()->output($this->src_dir . '/drm_pssh/audio.mp4')
            ->drmLabel('AUDIO');
        $video = $this->getVideoStream()->output($this->src_dir . '/drm_pssh/video.mp4')
            ->drmLabel('SD');

        return [$audio, $video];
    }

    private function getAudioStream()
    {
        return $this->getDRMStream()->streamSelector('audio');
    }

    private function getVideoStream()
    {
        return $this->getDRMStream()->streamSelector('video');
    }
}