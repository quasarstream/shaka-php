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
    protected function __getHlsMasterPlaylistOutput()
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
    public function HLSMasterPlaylistOutput(string $hls_master_playlist_output): HLS
    {
        $this->hls_master_playlist_output = $hls_master_playlist_output;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getHlsBaseUrl()
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
    public function HLSBaseUrl(string $hls_base_url): HLS
    {
        $this->hls_base_url = $hls_base_url;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getHlsKeyUri()
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
    public function HLSKeyUri(string $hls_key_uri): HLS
    {
        $this->hls_key_uri = $hls_key_uri;
        return $this;
    }

    /**
     * @return array
     */
    protected function __getHlsPlaylistType()
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
    public function HLSPlaylistType(string $hls_playlist_type): HLS
    {
        $this->hls_playlist_type = $hls_playlist_type;
        return $this;
    }
}