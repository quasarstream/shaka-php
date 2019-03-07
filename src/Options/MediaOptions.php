<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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



    //General Encryption Options
    const PROTECTION_SCHEME = '--protection_scheme';

    const VP9_SUBSAMPLE_ENCRYPTION = '--vp9_subsample_encryption';

    const NOVP9_SUBSAMPLE_ENCRYPTION = '--novp9_subsample_encryption';

    const CLEAR_LEAD = '--clear_lead';

    const PROTECTION_SYSTEMS = '--protection_systems';



    //Widevine Encryption Options
    const ENABLE_WIDEVINE_ENCRYPTION = '--enable_widevine_encryption';

    const ENABLE_WIDEVINE_DECRYPTION = '--enable_widevine_decryption';

    const KEY_SERVER_URL = '--key_server_url';

    const CONTENT_ID = '--content_id';

    const POLICY = '--policy';

    const MAX_SD_PIXELS = '--max_sd_pixels';

    const MAX_HD_PIXELS = '--max_hd_pixels';

    const MAX_UHD1_PIXELS = '--max_uhd1_pixels';

    const SIGNER = '--signer';

    const AES_SIGNING_KEY = '--aes_signing_key';

    const AES_SIGNING_IV = '--aes_signing_iv';

    const RSA_SIGNING_KEY_PATH = '--rsa_signing_key_path';

    const CRYPTO_PERIOD_DURATION = '--crypto_period_duration';

    const GROUP_ID = '--group_id';


    //PlayReady Encryption Options
    const ENABLE_PLAYREADY_ENCRYPTION = '--enable_playready_encryption';

    const PLAYREADY_SERVER_URL = '--playready_server_url';

    const PROGRAM_IDENTIFIER = '--program_identifier';

    const CA_FILE = '--ca_file';

    const CLIENT_CERT_FILE = '--client_cert_file';

    const CLIENT_CERT_PRIVATE_KEY_FILE = '--client_cert_private_key_file';

    const CLIENT_CERT_PRIVATE_KEY_PASSWORD = '--client_cert_private_key_password';


    //Raw Encryption Options
    const ENABLE_RAW_KEY_ENCRYPTION = '--enable_raw_key_encryption';

    const ENABLE_RAW_KEY_DECRYPTION = '--enable_raw_key_decryption';

    const KEYS = '--keys';

    const IV = '--iv';

    const PSSH = '--pssh';


    //AdInsertion Option
    const AD_CUES = '--ad_cues';
}