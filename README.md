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


For users that get prebuilt binary: Please rename `packager-'OS'` to `packager` and add the path of shaka packager to your system PATH.(e.g. 'packager-win.exe' to 'packager.exe')

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

##### All possible options of stream:

|           option    	        |           default             |                                                       mean                         	                                |
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

