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


class HLS extends General
{
    /** @var string */
    private $hls_master_playlist_output;

    /** @var string */
    private $hls_base_url;

    /** @var string */
    private $hls_key_uri;

    /** @var string */
    private $hls_playlist_type;

    /**
     * @return array
     */
    protected function getHlsMasterPlaylistOutput()
    {
        if (!$this->hls_master_playlist_output) {
            return null;
        }

        return [MediaOptions::HLS_MASTER_PLAYLIST_OUTPUT, $this->hls_master_playlist_output];
    }

    /**
     * @param string $hls_master_playlist_output
     * @return HLS
     */
    public function setHlsMasterPlaylistOutput(string $hls_master_playlist_output): HLS
    {
        $this->hls_master_playlist_output = $hls_master_playlist_output;
        return $this;
    }

    /**
     * @return array
     */
    protected function getHlsBaseUrl()
    {
        if (!$this->hls_base_url) {
            return null;
        }

        return [MediaOptions::HLS_BASE_URL, $this->hls_base_url];
    }

    /**
     * @param string $hls_base_url
     * @return HLS
     */
    public function setHlsBaseUrl(string $hls_base_url): HLS
    {
        $this->hls_base_url = $hls_base_url;
        return $this;
    }

    /**
     * @return array
     */
    protected function getHlsKeyUri()
    {
        if (!$this->hls_key_uri) {
            return null;
        }

        return [MediaOptions::HLS_KEY_URI, $this->hls_key_uri];
    }

    /**
     * @param string $hls_key_uri
     * @return HLS
     */
    public function setHlsKeyUri(string $hls_key_uri): HLS
    {
        $this->hls_key_uri = $hls_key_uri;
        return $this;
    }

    /**
     * @return array
     */
    protected function getHlsPlaylistType()
    {
        if (!$this->hls_playlist_type) {
            return null;
        }

        return [MediaOptions::HLS_PLAYLIST_TYPE, $this->hls_playlist_type];
    }

    /**
     * @param string $hls_playlist_type
     * @return HLS
     */
    public function setHlsPlaylistType(string $hls_playlist_type): HLS
    {
        $this->hls_playlist_type = $hls_playlist_type;
        return $this;
    }
}