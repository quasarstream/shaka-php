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


use Shaka\Media\Analysis;
use Shaka\Media\AnalysisStream\StreamCollection;

class AnalysisTest extends TestCase
{
    public function testAnalysisClass()
    {
        $this->assertInstanceOf(Analysis::class, $this->getShaka()->streams($this->getStream())->mediaFileAnalysis());
    }

    public function testAnalysis()
    {
        $analysis = $this->getAnalysis()->export();

        $output_width = intval($analysis->first()->get('width'));
        $output_video = $analysis->videos()[0]->all();
        $output_audio = $analysis->audios()[0]->all();

        $expected_video = json_decode(file_get_contents(__DIR__ . "/fixtures/streams/video_stream.json"), true);
        $expected_audio = json_decode(file_get_contents(__DIR__ . "/fixtures/streams/audio_stream.json"), true);

        $this->assertInstanceOf(StreamCollection::class, $analysis);

        $this->assertEquals($expected_video, $output_video);
        $this->assertEquals($expected_audio, $output_audio);
        $this->assertEquals(640, $output_width);
    }

    public function testStringAnalysis()
    {
        $output = (string)$this->getAnalysis();
        $expected = str_replace("DIRECTORY_PATH", $this->src_dir, file_get_contents(__DIR__ . "/fixtures/streams/show_streams.raw"));

        //just for appveyor build
        $expected = str_replace("\r\n","\n", $expected);

        $this->assertEquals($expected, $output);
    }

    private function getAnalysis()
    {
        return $this->getShaka()->streams($this->getStream())->mediaFileAnalysis();
    }
}