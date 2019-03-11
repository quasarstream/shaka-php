# Shaka PHP
Shaka PHP is a library that uses [Shaka Packager](https://github.com/google/shaka-packager) for DASH and HLS packaging and encryption, supporting Common Encryption for Widevine and other DRM Systems.

- [Installation](#installation)
  - [Getting Shaka Packager](#getting-shaka-packager)
  - [Installing Package](#installing-package)
- [Usage](#usage)
  - [Basic Usage](#basic-usage)
  - [DASH](#dash)
  - [HLS](#basic-usage)
  - [Live](#basic-usage)
  - [DRM](#basic-usage)
    - [Widevine Key Server](#basic-usage)
    - [PlayReady Key Server](#basic-usage)
    - [Raw Key](#basic-usage)
  - [Ad Insertion](#basic-usage)
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

|           Option    	        |           Default             |                                                       Mean                         	                                |
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

### DASH
[Dynamic Adaptive Streaming over HTTP](https://en.wikipedia.org/wiki/Dynamic_Adaptive_Streaming_over_HTTP) (DASH) is an adaptive bitrate streaming technique that enables high quality streaming of media content over HTTP.

#### Dash Stream Options
Besides [Stream Options](#stream-options) and [DRM Options](#drm-options), you can add `DASHRoles()` method to your DASHStream object. You can pass roles to the method. The roles can be separated by colon or semi-colon. The value should be one of: caption, subtitle, main, alternate, supplementary, commentary and dub. See [DASH (ISO/IEC 23009-1)](https://www.iso.org/standard/65274.html) specification for details.  

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


You can add options to your dash using a callback method:

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
|           Option    	                           |           Default             |                                                       Mean                         	                                |
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

#### Chunking options and MP4 output options
Also you can add `Chunking options` and `MP4 output options` to your DASH Object:


|           Option    	                           |           Default             |                                                       Mean                         	                                |
|:------------------------------------------------:|:-----------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       Mp4IncludePsshInStream()                   |           NULL                |        	MP4 only: include pssh in the encrypted stream. Default enabled.                              |
|       generateSidxInMediaSegments()              |           NULL                |         For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                                                                      |
|       nogenerateSidxInMediaSegments()            |           NULL                |          	For MP4 with DASH live profile only: Indicates whether to generate ‘sidx’ box in media segments. Note that it is reuqired by spec if segment template contains $Time$ specifier.                               	|
|       transportStreamTimestampOffsetMs()         |           100ms                |           	Transport stream only (MPEG2-TS, HLS Packed Audio): A positive value, in milliseconds, by which output timestamps are offset to compensate for possible negative timestamps in the input. For example, timestamps from ISO-BMFF after adjusted by EditList could be negative. In transport streams, timestamps are not allowed to be less than zero.                    	|
|       segmentDuration()                          |           NULL                |          Segment duration in seconds. If single_segment is specified, this parameter sets the duration of a subsegment; otherwise, this parameter sets the duration of a segment. Actual segment durations may not be exactly as requested.                    	|
|       fragmentDuration()                         |           NULL                |          Fragment duration in seconds. Should not be larger than the segment duration. Actual fragment durations may not be exactly as requested.                            	|
|       segmentSapAligned()        	               |           FALSE               |          Force segments to begin with stream access points. Default enabled.                    	|
|       fragmentSapAligned()                       |           FALSE               |          Force fragments to begin with stream access points. This flag implies segment_sap_aligned. Default enabled.                            	|


#### Segment Template Formatting
The implementation is based on Template-based Segment URL construction described in ISO/IEC 23009-1:2014.


|           $<Identifier>$                         |           Substitution parameter                                                         |                                                       Format                         	                                |
|:------------------------------------------------:|:----------------------------------------------------------------------------------------:|:---------------------------------------------------------------------------------------------------------------------:|
|       $$                                         |           is an escape sequence, i.e. “$$” is replaced with a single “$”.                |        	Not applicable.                              |
|       $Number$                                   |           This identifier is substitued with the number of the corresponding Segment.    |         The format tag may be present. If no format tag is present, a default format tag with width=1 shall be used.                                          |
|       $Time$                                     |           This identifier is substituted with the value of the SegmentTimeline@t attribute for the Segment being accessed. Either $Number$ or $Time$ may be used but not both at the same time.                |          	The format tag may be present. If no format tag is present, a default format tag with width=1 shall be used.                               	|


#### DASH Examples
Please see [examples](/examples) for details.





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

