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

    //DASH Options
    const GENERATE_STATIC_MPD = '--generate_static_mpd';

    const MPD_OUTPUT = '--mpd_output';

    const BASE_URLS = '--base_urls';

    const MIN_BUFFER_TIME = '--min_buffer_time';

    const MINIMUM_UPDATE_PERIOD = '--minimum_update_period';

    const SUGGESTED_PRESENTATION_DELAY = '--suggested_presentation_delay';

    const TIME_SHIFT_BUFFER_DEPTH = '--time_shift_buffer_depth';

    const PRESERVED_SEGMENTS_OUTSIDE_LIVE_WINDOW = '--preserved_segments_outside_live_window';

    const UTC_TIMINGS = '--utc_timings';

    const DEFAULT_LANGUAGE = '--default_language';

    const DEFAULT_TEXT_LANGUAGE = '--default_text_language';



}