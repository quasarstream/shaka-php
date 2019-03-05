<?php

/**
 * Copyright 2019 Amin Yazdanpanah<http://www.aminyazdanpanah.com>.
 *
 * Licensed under the MIT License;
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      https://opensource.org/licenses/MIT
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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