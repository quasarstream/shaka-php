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


class StreamOptionsTest extends TestCase
{
    public function testStream()
    {
        $output = $this->getStream()
            ->streamSelector('whatever')
            ->output('whatever')
            ->initSegment('whatever')
            ->segmentTemplate('whatever')
            ->bandwidth('whatever')
            ->language('whatever')
            ->outputFormat('whatever')
            ->trickPlayFactor('whatever')
            ->build();

        $expected = str_replace("DIRECTORY_PATH", $this->src_dir, file_get_contents(__DIR__ . "/fixtures/options/stream_options.raw"));

        $this->assertEquals($expected, $output);
    }

    public function testDRMStream()
    {
        $output = $this->getDRMStream()
            ->skipEncryption('whatever')
            ->drmLabel('whatever')
            ->streamSelector('whatever')
            ->output('whatever')
            ->initSegment('whatever')
            ->segmentTemplate('whatever')
            ->bandwidth('whatever')
            ->language('whatever')
            ->outputFormat('whatever')
            ->trickPlayFactor('whatever')
            ->build();

        $expected = str_replace("DIRECTORY_PATH", $this->src_dir, file_get_contents(__DIR__ . "/fixtures/options/drm_stream_options.raw"));

        $this->assertEquals($expected, $output);
    }

    public function testDASHStream()
    {
        $output = $this->getDASHStream()
            ->DASHRoles('whatever')
            ->skipEncryption('whatever')
            ->drmLabel('whatever')
            ->streamSelector('whatever')
            ->output('whatever')
            ->initSegment('whatever')
            ->segmentTemplate('whatever')
            ->bandwidth('whatever')
            ->language('whatever')
            ->outputFormat('whatever')
            ->trickPlayFactor('whatever')
            ->build();

        $expected = str_replace("DIRECTORY_PATH", $this->src_dir, file_get_contents(__DIR__ . "/fixtures/options/dash_stream_options.raw"));

        $this->assertEquals($expected, $output);
    }

    public function testHLSStream()
    {
        $output = $this->getHLSStream()
            ->HLSName('whatever')
            ->HLSGroupId('whatever')
            ->playlistName('whatever')
            ->iframePlaylistName('whatever')
            ->HLSCharacteristics('whatever')
            ->skipEncryption('whatever')
            ->drmLabel('whatever')
            ->streamSelector('whatever')
            ->output('whatever')
            ->initSegment('whatever')
            ->segmentTemplate('whatever')
            ->bandwidth('whatever')
            ->language('whatever')
            ->outputFormat('whatever')
            ->trickPlayFactor('whatever')
            ->build();

        $expected = str_replace("DIRECTORY_PATH", $this->src_dir, file_get_contents(__DIR__ . "/fixtures/options/hls_stream_options.raw"));

        $this->assertEquals($expected, $output);
    }
}