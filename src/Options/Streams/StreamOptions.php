<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Streams;


class StreamOptions
{

    //Main Stream
    const INPUT = 'in';

    const STREAM_SELECTOR = 'stream';

    const OUTPUT = 'out';

    const INIT_SEGMENT = 'init_segment';

    const SEGMENT_TEMPLATE = 'segment_template';

    const BANDWIDTH = 'bw';

    const LANGUAGE = 'lang';

    const OUTPUT_FORMAT = 'format';

    const TRICK_PLAY_FACTOR = 'tpf';


    //DRM Stream
    const SKIP_ENCRYPTION = 'skip_encryption';

    const DRM_LABEL = 'drm_label';


    //DASH Stream
    const DASH_ROLES = 'roles';


    //HLS Stream
    const HLS_NAME = 'hls_name';

    const HLS_GROUP_ID = 'hls_group_id';

    const PLAYLIST_NAME = 'playlist_name';

    const IFRAME_PLAYLIST_NAME = 'iframe_playlist_name';

    const HLS_CHARACTERISTICS = 'charcs';
}