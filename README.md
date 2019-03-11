# Shaka PHP
Shaka PHP is a library that uses [Shaka Packager](https://github.com/google/shaka-packager) for DASH and HLS packaging and encryption, supporting Common Encryption for Widevine and other DRM Systems.

- [Installation](#installation)
  - [Getting Shaka Packager](#getting-shaka-packager)
  - [Installing Package](#installing-package)
- [Usage](#usage)
  - [Basic Usage](#basic-usage)
  - [DASH](#dash)
  - [HLS](#hls)
  - [Live](#live)
  - [DRM](#drm)
    - [Widevine Key Server](#widevine-key-server)
    - [PlayReady Key Server](#playready-key-server)
    - [Raw Key](#raw-key-server)
  - [Ad Insertion](#ad-insertion)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Installation
This library requires a working Shaka Packager binary. Be that the binary can be located with system PATH to auto get binary file in PHP.
Also you can give the binary path on load.

### Getting Shaka Packager
There are several ways you can get Shaka Packager.

- Using [Docker](https://www.docker.com/whatisdocker). Instructions are available at [Using Docker](https://google.github.io/shaka-packager/html/docker_instructions.html).
- Get prebuilt binaries from [release](https://github.com/google/shaka-packager/releases).
- Built from source, see [Build Instructions](https://google.github.io/shaka-packager/html/build_instructions.html) for details.


For users who get prebuilt binary: Please rename `packager-'OS'` to `packager` and add the path of shaka packager to your system PATH.(e.g. 'packager-win.exe' to 'packager.exe')

### Installing Package

Use [Composer](https://getcomposer.org) to install this library from Packagist:
[``](https://packagist.org/packages/google/recaptcha)

Run the following command from your project directory to add the dependency:

``` sh
composer 
```

Alternatively, add the dependency directly to your `composer.json` file:

``` json
"require": {
    "": "^"
}
```

## Usage
The best way to learn how to use this library is to review the [examples](/examples) and browse the source code as it is self-documented.

### Basic Usage
#### Initializing
Shaka PHP detects `packager` binary, but you can explicitly give the binary path to the `initialize` method:
```php
$shaka = \Shaka\Shaka::initialize('/the/path/to/the/binary/packager');
```

#### Streams
There can be multiple `streams` with input from the same “file” or multiple different “files”.
``` php
$stream1 = \Shaka\Options\Streams\Stream::input('/the/path/to/the/file');
$stream2 = \Shaka\Options\Streams\Stream::input('/the/path/to/the/file');
//...
```

you can add options to your streams
``` php
$stream1->streamSelector('video')
        ->output('video.mp4');
```

##### Stream Options

|           Option    	        |           Default             |                                                       Explanation                         	                                |
|:-----------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       streamSelector()        |           NULL                |        Required field with value ‘audio’, ‘video’, ‘text’ or stream number (zero based).                              |
|       output()                |           NULL                |         Required output file path (single file).                                                                      |
|       initSegment()           |           NULL                |          	initialization segment path (multiple file).                               	|
|       segmentTemplate()       |           NULL                |           Optional value which specifies the naming pattern for the segment files, and that the stream should be split into multiple files. Its presence should be consistent across streams.                    	|
|       bandwidth()           	|           NULL                |          Optional value which contains a user-specified maximum bit rate for the stream, in bits/sec. If specified, this value is propagated to (HLS) EXT-X-STREAM-INF:BANDWIDTH or (DASH) Representation@bandwidth and the $Bandwidth$ template parameter for segment names. If not specified, the bandwidth value is estimated from content bitrate. Note that it only affects the generated manifests/playlists; it has no effect on the media content itself.                    	|
|       language()              |           NULL                |          Optional value which contains a user-specified language tag. If specified, this value overrides any language metadata in the input stream.                            	|
|       outputFormat()        	|           NULL                |          Optional value which specifies the format of the output files (MP4 or WebM). If not specified, it will be derived from the file extension of the output file.                    	|
|       trickPlayFactor()       |           0                   |          Optional value which specifies the trick play, a.k.a. trick mode, stream sampling rate among key frames. If specified, the output is a trick play stream.                            	|


#### Media file analysis
It can be used to inspect the content of a media file and dump basic stream information:
``` php
$export = $shaka->streams($stream)
    ->mediaFileAnalysis()
    ->export();
```
The `$export` is instance of `StreamCollection`. For more information, please see [examples](/examples).

#### Basic transmuxing
It can be used to extract streams, optionally transmuxes the streams from one container format to another container format.
``` php
$stream1 = Stream::input('/the/path/to/the/file')
    ->streamSelector('video')
    ->output('video.mp4');

$stream2 = Stream::input('/the/path/to/the/file')
    ->streamSelector('audio')
    ->output('audio.mp4');

$export = $shaka->streams($stream1, $stream2)
            ->mediaPackaging()
            ->export();
```
#### Basic Usage Examples
Please see [examples/Basic](/examples/basic) for details.

### DASH
[Dynamic Adaptive Streaming over HTTP](http://dashif.org/) (DASH) is an adaptive bitrate streaming technique that enables high quality streaming of media content over HTTP.

#### DASH Stream Options
Besides [Stream Options](#stream-options) and [DRM Stream Options](#drm-stream-options), you can add `DASHRoles()` method to your DASHStream object. You can pass roles to the method. The roles can be separated by colon or semi-colon. The value should be one of: caption, subtitle, main, alternate, supplementary, commentary and dub. See [DASH (ISO/IEC 23009-1)](https://www.iso.org/standard/65274.html) specification for details.  

``` php
$stream1 = $stream1 = DASHStream::input('/the/path/to/the/file')
                        //->other options
```


#### DASH Packaging
This library supports DASH content packaging.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->DASH('output.mpd')
    ->export();
```


You can add options to your DASH object using a callback method:

``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->DASH('output.mpd', function ($options) {
        return $options->generateStaticMpd();
            //->other options;
    })
    ->export();
```

#### DASH Options
|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       generateStaticMpd()                        |           FALSE               |        If enabled, generates static mpd. If segment_template is specified in stream descriptors, shaka-packager generates dynamic mpd by default; if this flag is enabled, shaka-packager generates static mpd instead. Note that if segment_template is not specified, shaka-packager always generates static mpd regardless of the value of this flag.                              |
|       baseUrls()                                 |           NULL                |        Comma separated BaseURLs for the MPD: <url>[,<url>]…. The values will be added as <BaseURL> element(s) immediately under the <MPD> element.                                                    |
|       minBufferTime()                            |           NULL                |          	Specifies, in seconds, a common duration used in the definition of the MPD Representation data rate.                               	|
|       minimumUpdatePeriod()                      |           NULL                |           Indicates to the player how often to refresh the media presentation description in seconds. This value is used for dynamic MPD only.                    	|
|       suggestedPresentationDelay()               |           NULL                |          Specifies a delay, in seconds, to be added to the media presentation time. This value is used for dynamic MPD only.                    	|
|       timeShiftBufferDepth()        	           |           NULL                |          Guaranteed duration of the time shifting buffer for dynamic media presentations, in seconds.                    	|
|       preservedSegmentsOutsideLiveWindow()       |           NULL                |          Segments outside the live window (defined by time_shift_buffer_depth above) are automatically removed except for the most recent X segments defined by this parameter. This is needed to accommodate latencies in various stages of content serving pipeline, so that the segments stay accessible as they may still be accessed by the player. The segments are not removed if the value is zero.                            	|
|       utcTimings()                               |           NULL                |          Comma separated UTCTiming schemeIdUri and value pairs for the MPD: <scheme_id_uri>=<value>[,<scheme_id_uri>=<value>]… This value is used for dynamic MPD only.                            	|
|       defaultLanguage()                          |           NULL                |          Any audio/text tracks tagged with this language will have <Role … value=”main” /> in the manifest. This allows the player to choose the correct default language for the content. This applies to both audio and text tracks. The default language for text tracks can be overriden by ‘default_text_language’.                            	|
|       defaultTextLanguage()                      |           NULL                |          	Same as above, but this applies to text tracks only, and overrides the default language for text tracks.                            	|
|       allowApproximateSegmentTimeline()          |           NULL                |          For live profile only. If enabled, segments with close duration (i.e. with difference less than one sample) are considered to have the same duration. This enables MPD generator to generate less SegmentTimeline entries. If all segments are of the same duration except the last one, we will do further optimization to use SegmentTemplate@duration instead and omit SegmentTimeline completely. Ignored if $Time$ is used in segment template, since $Time$ requires accurate Segment Timeline.                            	|

Also you can add some `Chunking` and `MP4 output` options to your DASH Object(before using these options, please read the `Explanation`):

#### Chunking and MP4 Output Options

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       Mp4IncludePsshInStream()                   |           TRUE                |        	MP4 only: include pssh in the encrypted stream.                              |
|       generateSidxInMediaSegments()              |           NULL                |         For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                                                                      |
|       nogenerateSidxInMediaSegments()            |           NULL                |          	For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                               	|
|       transportStreamTimestampOffsetMs()         |           100ms               |           	Transport stream only (MPEG2-TS, HLS Packed Audio): A positive value, in milliseconds, by which output timestamps are offset to compensate for possible negative timestamps in the input. For example, timestamps from ISO-BMFF after adjusted by EditList could be negative. In transport streams, timestamps are not allowed to be less than zero.                    	|
|       segmentDuration()                          |           NULL                |          Segment duration in seconds. If single_segment is specified, this parameter sets the duration of a subsegment; otherwise, this parameter sets the duration of a segment. Actual segment durations may not be exactly as requested.                    	|
|       fragmentDuration()                         |           NULL                |          Fragment duration in seconds. Should not be larger than the segment duration. Actual fragment durations may not be exactly as requested.                            	|
|       segmentSapAligned()        	               |           TRUE                |          Force segments to begin with stream access points.                    	|
|       fragmentSapAligned()                       |           TRUE                |          Force fragments to begin with stream access points. This flag implies segment_sap_aligned.                            	|


The implementation is based on Template-based Segment URL construction described in ISO/IEC 23009-1:2014.

#### Segment Template Formatting

|           $ Identifier $                         |           Substitution parameter                                                         |                                                       Format                         	                                |
|:------------------------------------------------:|:----------------------------------------------------------------------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       $$                                         |           is an escape sequence, i.e. “$$” is replaced with a single “$”.                |        	Not applicable.                              |
|       $Number$                                   |           This identifier is substitued with the number of the corresponding Segment.    |         The format tag may be present. If no format tag is present, a default format tag with width=1 shall be used.                                          |
|       $Time$                                     |           This identifier is substituted with the value of the SegmentTimeline@t attribute for the Segment being accessed. Either $Number$ or $Time$ may be used but not both at the same time.                |          	The format tag may be present. If no format tag is present, a default format tag with width=1 shall be used.                               	|
- **Note**: Identifiers $RepresentationID$ and $Bandwidth$ are not supported in this version. Please file an issue if you want it to be supported.

#### DASH Examples
Please see [examples/DASH](/examples/dash) for details.




### HLS
[HTTP Live Streaming](https://developer.apple.com/streaming/) (also known as HLS) is an HTTP-based media streaming communications protocol implemented by Apple Inc. as part of its QuickTime, Safari, OS X, and iOS software. It resembles MPEG-DASH in that it works by breaking the overall stream into a sequence of small HTTP-based file downloads, each download loading one short chunk of an overall potentially unbounded transport stream. As the stream is played, the client may select from a number of different alternate streams containing the same material encoded at a variety of data rates, allowing the streaming session to adapt to the available data rate. At the start of the streaming session, HLS downloads an extended M3U playlist containing the metadata for the various sub-streams which are available.

#### HLS Stream Options
Besides [Stream Options](#stream-options) and [DRM Stream Options](#drm-stream-options), you can add options below:

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       HLSName()                                  |           NULL                |        	MP4 only: include pssh in the encrypted stream.                              |
|       HLSGroupId()                               |           NULL                |         For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                                                                      |
|       playlistName()                             |           NULL                |          	For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                               	|
|       iframePlaylistName()                       |           NULL                |           	Transport stream only (MPEG2-TS, HLS Packed Audio): A positive value, in milliseconds, by which output timestamps are offset to compensate for possible negative timestamps in the input. For example, timestamps from ISO-BMFF after adjusted by EditList could be negative. In transport streams, timestamps are not allowed to be less than zero.                    	|
|       HLSCharacteristics()                       |           NULL                |          Segment duration in seconds. If single_segment is specified, this parameter sets the duration of a subsegment; otherwise, this parameter sets the duration of a segment. Actual segment durations may not be exactly as requested.                    	|


``` php
$stream1 = $stream1 = HLSStream::input('/the/path/to/the/file')
                        //->other options
```


#### HLS Packaging
This library supports HLS content packaging.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->HLS('output.m3u8')
    ->export();
```

You can add options to your HLS object using a callback method:

``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->HLS('output.m3u8', function ($options) {
        return $options->HLSMasterPlaylistOutput();
            //->other options;
    })
    ->export();
```

#### HLS Options
|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       HLSMasterPlaylistOutput()                        |           NULL               |        Output path for the master playlist for HLS. This flag must be used to output HLS.                              |
|       HLSBaseUrl()                                 |           NULL                |        The base URL for the Media Playlists and media files listed in the playlists. This is the prefix for the files.                                   |
|       HLSKeyUri()                            |           NULL                |          	The key uri for ‘identity’ and ‘com.apple.streamingkeydelivery’ (FairPlay) key formats. Ignored if the playlist is not encrypted or not using the above key formats.          	|
|       HLSPlaylistType()                      |           NULL                |           VOD, EVENT, or LIVE. This defines the EXT-X-PLAYLIST-TYPE in the HLS specification. For hls_playlist_type of LIVE, EXT-X-PLAYLIST-TYPE tag is omitted.                    	|
|       timeShiftBufferDepth()        	           |           NULL                |          Guaranteed duration of the time shifting buffer for LIVE playlists, in seconds.                    	|
|       preservedSegmentsOutsideLiveWindow()       |           NULL                |          Segments outside the live window (defined by time_shift_buffer_depth above) are automatically removed except for the most recent X segments defined by this parameter. This is needed to accommodate latencies in various stages of content serving pipeline, so that the segments stay accessible as they may still be accessed by the player. The segments are not removed if the value is zero.                            	|
|       defaultLanguage()                          |           NULL                |          Any audio/text tracks tagged with this language will have <Role … value=”main” /> in the manifest. This allows the player to choose the correct default language for the content. This applies to both audio and text tracks. The default language for text tracks can be overriden by ‘default_text_language’.                            	|
|       defaultTextLanguage()                      |           NULL                |          	Same as above, but this applies to text tracks only, and overrides the default language for text tracks.                            	|

Also you can add some [Chunking and MP4 output options](#chunking-and-mp4-output-options) to your HLS Object(before using these options, please read the `Explanation`).
 - **Note**: Also you can use [Segment template formatting](#segment-template-formatting) in your output.


 - **Note**: DASH and HLS options can both be specified to output DASH and HLS manifests at the same time. Note that it works only for MP4 outputs.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->HLS('hls.m3u8')
    ->DASH('dash.mpd')
    ->export();
```

#### HLS Examples
Please see [examples/HLS](/examples/hls) for details.

## Live
A typical live source is UDP multicast, which is the only live protocol packager supports directly right now.

For other unsupported protocols, you can use FFmpeg to pipe the input. See [FFmpeg piping](https://google.github.io/shaka-packager/html/tutorials/ffmpeg_piping.html) for details.


### UDP File Options
UDP file is of the form:
``` text 
udp://<ip>:<port>[?<option>[&<option>]...]
```

|           Option    	                           |                                                       Explanation                         	                                |
|:------------------------------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       buffer_size                                |        UDP maximum receive buffer size in bytes. Note that although it can be set to any value, the actual value is capped by maximum allowed size defined by the underlying operating system. On linux, the maximum size allowed can be retrieved using sysctl net.core.rmem_max and configured using sysctl -w net.core.rmem_max=<size_in_bytes>.           |
|       interface                                  |        Multicast group interface address. Only the packets sent to this address are received. Default to “0.0.0.0” if not specified.      |
|       reuse                                      |        Allow or disallow reusing UDP sockets. 	|
|       source                                     |        Multicast source ip address. Only the packets sent from this source address are received. Enables Source Specific Multicast (SSM) if set.    	|
|       timeout        	                           |        UDP timeout in microseconds.   	|


#### Example:
``` text 
udp://224.1.2.30:88?interface=10.11.12.13&reuse=1
```
#### HLS Examples
Please see [examples/Live](/examples/live) for details.


## DRM
Shaka Packager supports fetching encryption keys from Widevine Key Server and PlayReady Key Server. Shaka Packager also supports Raw Keys, for which keys are provided to Shaka Packager directly.

Regardless of which key server you are using, you can instruct Shaka Packager to generate other protection systems in additional to the native protection system from the key server. This allows generating multi-DRM contents easily.

### DRM Stream options
Besides [Stream Options](#stream-options), you can add options below:

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       skipEncryption()                           |           0                   |        	Optional. If it is set to 1, no encryption of the stream will be made.     |
|       drmLabel()                                 |           NULL                |         Optional value for custom DRM label, which defines the encryption key applied to the stream. Typically values include AUDIO, SD, HD, UHD1, UHD2. For raw key, it should be a label defined in –keys. If not provided, the DRM label is derived from stream type (video, audio), resolutions, etc. Note that it is case sensitive.  |

### General encryption options

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       protectionScheme()                         |           NULL                |       Specify a protection scheme, ‘cenc’ or ‘cbc1’ or pattern-based protection schemes ‘cens’ or ‘cbcs’.    |
|       vp9SubsampleEncryption()                   |           TRUE                |        Enable / disable VP9 subsample encryption    |
|       novp9SubsampleEncryption()                 |           FALSE               |        Enable / disable VP9 subsample encryption  |
|       clearLead()                                |           NULL                |         Clear lead in seconds if encryption is enabled.  |
|       protectionSystems()                        |           NULL                |         Protection systems to be generated. Supported protection systems include Widevine, PlayReady, FairPlay, Marlin, and CommonSystem (https://goo.gl/s8RIhr).  |

### Widevine Key Server
The easiest way to generate Widevine protected content is to use Widevine Cloud Service.

Shaka Packager can talk to Widevine Cloud Service or any key server that implements [Common Encryption API for Widevine DRM](http://bit.ly/2vTG4oo) to fetch encryption keys.

Widevine Common Encryption API supports request validation using either AES or RSA.

Enable encryption with Widevine key server. User should provide either AES signing key (`aesSigningKey()`, `aesSigningIv()`) or RSA signing key (`rsaSigningKeyPath()`).
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->DRM('widevine', function ($options) {
        return $options->keyServerUrl('https://license.uat.widevine.com/cenc/getcontentkey/widevine_test')
            ->//other options
    })
    ->HLS('hls.m3u8')
    ->DASH('dash.mpd')
    ->export();
```

#### Widevine Options
Besides [General encryption options](#general-encryption-options), you can add options below:

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       enableWidevineDecryption()                 |           FALSE               |         Enable decryption  with Widevine key server. User should provide either AES signing key (`aesSigningKey()`, `aesSigningIv()`) or RSA signing key (`rsaSigningKeyPath()`).    |
|       keyServerUrl()                             |           NULL                |         Key server url. Required for Widevine encryption and decryption.    |
|       contentId()                                |           NULL                |         Content identifier that uniquely identifies the content. |
|       policy()                                   |           NULL                |         The name of a stored policy, which specifies DRM content rights.  |
|       maxSdPixels()                              |           NULL                |         The video track is considered SD if its max pixels per frame is no higher than max_sd_pixels. Default: 442368 (768 x 576).  |
|       maxHdPixels()                              |           NULL                |         The video track is considered HD if its max pixels per frame is higher than `maxSdPixels()`, but no higher than max_hd_pixels. Default: 2073600 (1920 x 1080).  |
|       maxUhd1Pixels()                            |           NULL                |         The video track is considered UHD1 if its max pixels per frame is higher than `maxPhdPixels()`, but no higher than max_uhd1_pixels. Otherwise it is UHD2. Default: 8847360 (4096 x 2160).  |
|       signer()                                   |           NULL                |         The name of the signer.  |
|       aesSigningKey()                            |           NULL                |         AES signing key in hex string. `aesSigningIv()` is required if aes_signing_key is specified. This option is exclusive with `rsaSigningKeyPath()`.  |
|       aesSigningIv()                             |           NULL                |         	AES signing iv in hex string.  |
|       rsaSigningKeyPath()                        |           NULL                |         Path to the file containing PKCS#1 RSA private key for request signing. This option is exclusive with `aesSigningKey()`.  |
|       cryptoPeriodDuration()                     |           NULL                |         Defines how often key rotates. If it is non-zero, key rotation is enabled.  |
|       groupId()                                  |           NULL                |         Identifier for a group of licenses.  |

#### Widevine Examples
Please see [examples/DRM/Widevine](/examples/drm/widevine) for details.


### PlayReady Key Server
This library can talk to PlayReady Key Server that implements [AcquirePackagingData Web Method specification](http://bit.ly/2M9NuOt) to fetch encryption keys.

Refer to [DRM](https://google.github.io/shaka-packager/html/tutorials/drm.html) if you are interested in generating multi-DRM contents.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->DRM('playReady', function ($options) {
        return $options->playreadyServerUrl('http://playready.get.key')
            ->//other options
    })
    ->HLS('hls.m3u8')
    ->DASH('dash.mpd')
    ->export();
```

#### PlayReady Options
Besides [General encryption options](#general-encryption-options), you can add options below:

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       playreadyServerUrl()                       |           NULL                |         PlayReady packaging server url.    |
|       programIdentifier()                        |           NULL                |         Program identifier for packaging request.    |
|       caFile()                                   |           NULL                |         Absolute path to the certificate authority file for the server cert. PEM format. Optional, depends on server configuration.  |
|       clientCertFile()                           |           NULL                |         Absolute path to client certificate file. Optional, depends on server configuration.  |
|       clientCertPrivateKeyFile()                 |           NULL                |         Absolute path to the private key file. Optional, depends on server configuration.  |
|       clientCertPrivateKeyPassword()             |           NULL                |         Password to the private key file. Optional, depends on server configuration.  |


### Raw Key Server
This library supports raw keys, for which keys and key_ids are provided to Shaka Packager directly.

This is often used if you are managing the encryption keys yourself. It also allows you to support multi-DRM by providing custom PSSHs.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->DRM('raw', function ($options) {
        return $options->keys('...keys')
            ->//other options
    })
    ->HLS('hls.m3u8')
    ->DASH('dash.mpd')
    ->export();
```

#### Raw Options
Besides [General encryption options](#general-encryption-options), you can add options below:

|           Option    	                           |           Default             |                                                       Explanation                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       enableRawKeyDecryption()                   |           FALSE               |         Enable decryption with raw key (keys provided in command line).    |
|       keys()                                     |           NULL                |         key_info_string is of the form: label=<label>:key_id=<key_id>:key=<key>label can be an arbitrary string or a predefined DRM label like AUDIO, SD, HD, etc. Label with an empty string indicates the default key and key_id.     |
|       iv()                                       |           NULL                |         IV in hex string format. If not specified, a random IV will be generated. This flag should only be used for testing. IV must be either 8 bytes (16 digits HEX) or 16 bytes (32 digits in HEX). |
|       pssh()                                     |           NULL                |         One or more concatenated PSSH boxes in hex string format. If neither this flag nor –protection_systems is specified, a v1 common PSSH box will be generated.  |

#### pssh-box (Utility to generate PSSH boxes)
https://github.com/google/shaka-packager/tree/master/packager/tools/pssh

#### Raw Examples
Please see [examples/DRM/Raw](/examples/drm/raw) for details.


## Ad Insertion
This package does not do Ad Insertion directly, but it can precondition content for [Dynamic Ad Insertion](https://support.google.com/admanager/answer/7295798?hl=en) with Google Ad Manager.

Both DASH and HLS are supported.
``` php
$export = $shaka->streams($stream1, $stream2, ...)
    ->mediaPackaging()
    ->HLS('hls.m3u8', function ($options) {
        return $options->adCues('600;1800;3000');
    })
    ->DASH('dash.mpd', function ($options) {
        return $options->adCues('600;1800;3000');
    })
    ->export();
```


#### Ad Insertion Examples
Please see [examples/adInsertion](/examples/adInsertion) for details.

## Contributing

I'd love your help in improving, correcting, adding to the specification.
Please [file an issue](https://github.com/aminyazdanpanah/shaka-php/issues)
or [submit a pull request](https://github.com/aminyazdanpanah/shaka-php/pulls).

Please see [Contributing File](https://github.com/aminyazdanpanah/shaka-php/blob/master/CONTRIBUTING.md) for more information.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Amin Yazdanpanah via:
contact [AT] aminyazdanpanah • com.
## Credits

- [Amin Yazdanpanah](http://www.aminyazdanpanah.com/?u=github.com/aminyazdanpanah/shaka-php)

## License

The MIT License (MIT). Please see [License File](https://github.com/aminyazdanpanah/shaka-php/blob/master/LICENSE) for more information.

