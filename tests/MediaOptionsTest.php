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


use Shaka\Options\DASH;
use Shaka\Options\DRM\PlayReady;
use Shaka\Options\DRM\Raw;
use Shaka\Options\DRM\Widevine;
use Shaka\Options\HLS;

class MediaOptionsTest extends TestCase
{
    public function testDASHOptions()
    {
        $output = (new DASH())->mpdOutput('whatever')
            ->generateStaticLiveMpd()
            ->baseUrls('whatever')
            ->minBufferTime('whatever')
            ->minimumUpdatePeriod('whatever')
            ->suggestedPresentationDelay('whatever')
            ->utcTimings('whatever')
            ->allowApproximateSegmentTimeline('whatever')
            ->timeShiftBufferDepth('whatever')
            ->preservedSegmentsOutsideLiveWindow('whatever')
            ->defaultLanguage('whatever')
            ->defaultTextLanguage('whatever')
            ->Mp4IncludePsshInStream('whatever')
            ->generateSidxInMediaSegments('whatever')
            ->nogenerateSidxInMediaSegments('whatever')
            ->transportStreamTimestampOffsetMs('whatever')
            ->segmentDuration('whatever')
            ->fragmentDuration('whatever')
            ->segmentSapAligned()
            ->fragmentSapAligned()
            ->adCues('whatever')
            ->export();

        $expected = json_decode(file_get_contents(__DIR__ . "/fixtures/options/dash_options.json"), true);

        $this->assertEquals($expected, $output);
    }
    public function testHLSOptions()
    {
        $output = (new HLS())->HLSMasterPlaylistOutput('whatever')
            ->HLSBaseUrl('whatever')
            ->HLSKeyUri('whatever')
            ->HLSPlaylistType('whatever')
            ->timeShiftBufferDepth('whatever')
            ->preservedSegmentsOutsideLiveWindow('whatever')
            ->defaultLanguage('whatever')
            ->defaultTextLanguage('whatever')
            ->Mp4IncludePsshInStream('whatever')
            ->generateSidxInMediaSegments('whatever')
            ->nogenerateSidxInMediaSegments('whatever')
            ->transportStreamTimestampOffsetMs('whatever')
            ->segmentDuration('whatever')
            ->fragmentDuration('whatever')
            ->segmentSapAligned(true)
            ->fragmentSapAligned(false)
            ->adCues('whatever')
            ->export();

        $expected = json_decode(file_get_contents(__DIR__ . "/fixtures/options/hls_options.json"), true);

        $this->assertEquals($expected, $output);
    }

    public function testWidevineOptions()
    {
        $output = (new Widevine())->enableEncryption()
            ->enableWidevineDecryption()
            ->keyServerUrl('whatever')
            ->contentId('whatever')
            ->policy('whatever')
            ->maxSdPixels('whatever')
            ->maxHdPixels('whatever')
            ->maxUhd1Pixels('whatever')
            ->signer('whatever')
            ->aesSigningKey('whatever')
            ->aesSigningIv('whatever')
            ->rsaSigningKeyPath('whatever')
            ->cryptoPeriodDuration('whatever')
            ->groupId('whatever')
            ->vp9SubsampleEncryption()
            ->novp9SubsampleEncryption()
            ->protectionScheme('whatever')
            ->clearLead('whatever')
            ->protectionSystems('whatever')
            ->export();

        $expected = json_decode(file_get_contents(__DIR__ . "/fixtures/options/widevine_options.json"), true);

        $this->assertEquals($expected, $output);
    }

    public function testPlayReadyOptions()
    {
        $output = (new PlayReady())->enableEncryption()
            ->playreadyServerUrl('whatever')
            ->programIdentifier('whatever')
            ->caFile('whatever')
            ->clientCertFile('whatever')
            ->clientCertPrivateKeyFile('whatever')
            ->clientCertPrivateKeyPassword('whatever')
            ->vp9SubsampleEncryption()
            ->novp9SubsampleEncryption()
            ->protectionScheme('whatever')
            ->clearLead('whatever')
            ->protectionSystems('whatever')
            ->export();

        $expected = json_decode(file_get_contents(__DIR__ . "/fixtures/options/paly_ready_options.json"), true);

        $this->assertEquals($expected, $output);
    }

    public function testRawOptions()
    {
        $output = (new Raw())->enableEncryption()
            ->EnableRawKeyDecryption()
            ->keys('whatever')
            ->iv('whatever')
            ->pssh('whatever')
            ->vp9SubsampleEncryption()
            ->novp9SubsampleEncryption()
            ->protectionScheme('whatever')
            ->clearLead('whatever')
            ->protectionSystems('whatever')
            ->export();

        $expected = json_decode(file_get_contents(__DIR__ . "/fixtures/options/raw_options.json"), true);

        $this->assertEquals($expected, $output);
    }
}