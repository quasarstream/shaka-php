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


namespace Shaka\Options;


class MediaOptions
{
    //DUMP STREAM INFO
    const DUMP_STREAM_INFO = '--dump_stream_info';


    //General Options
    const TIME_SHIFT_BUFFER_DEPTH = '--time_shift_buffer_depth';

    const PRESERVED_SEGMENTS_OUTSIDE_LIVE_WINDOW = '--preserved_segments_outside_live_window';

    const DEFAULT_LANGUAGE = '--default_language';

    const DEFAULT_TEXT_LANGUAGE = '--default_text_language';


    //DASH Options
    const GENERATE_STATIC_MPD = '--generate_static_mpd';

    const MPD_OUTPUT = '--mpd_output';

    const BASE_URLS = '--base_urls';

    const MIN_BUFFER_TIME = '--min_buffer_time';

    const MINIMUM_UPDATE_PERIOD = '--minimum_update_period';

    const SUGGESTED_PRESENTATION_DELAY = '--suggested_presentation_delay';

    const UTC_TIMINGS = '--utc_timings';

    const ALLOW_APPROXIMATE_SEGMENT_TIMELINE = '--allow_approximate_segment_timeline';


    //HLS Options
    const HLS_MASTER_PLAYLIST_OUTPUT = '--hls_master_playlist_output';

    const HLS_BASE_URL = '--hls_base_url';

    const HLS_KEY_URI = '--hls_key_uri';

    const HLS_PLAYLIST_TYPE = '--hls_playlist_type';


    //Chunking Options
    const SEGMENT_DURATION  = '--segment_duration';

    const FRAGMENT_DURATION = '--fragment_duration';

    const SEGMENT_SAP_ALIGNED = '--segment_sap_aligned';

    const FRAGMENT_SAP_ALIGNED = '--fragment_sap_aligned';


    //MP4 Output Options
    const MP4_INCLUDE_PSSH_IN_STREAM = '--mp4_include_pssh_in_stream';

    const GENERATE_SIDX_IN_MEDIA_SEGMENTS = '--generate_sidx_in_media_segments';

    const NOGENERATE_SIDX_IN_MEDIA_SEGMENTS = '--nogenerate_sidx_in_media_segments';

    const TRANSPORT_STREAM_TIMESTAMP_OFFSET_MS = '--transport_stream_timestamp_offset_ms';


    //AdInsertion Option
    const AD_CUES = '--ad_cues';
}