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


namespace Shaka\Streams;


class HLSStream extends DRMStream
{
    /** @var string */
    private $hls_name;

    /** @var string */
    private $hls_group_id;

    /** @var string */
    private $playlist_name;

    /** @var string */
    private $iframe_playlist_name;

    /** @var string */
    private $hls_characteristics;

    /**
     * @return string
     */
    protected function getHlsName()
    {
        if(!$this->hls_name){
            return null;
        }

        return StreamOptions::HLS_NAME . '=' . $this->hls_name;
    }

    /**
     * @param string $hls_name
     * @return HLSStream
     */
    public function setHlsName(string $hls_name): HLSStream
    {
        $this->hls_name = $hls_name;
        return $this;
    }

    /**
     * @return string
     */
    protected function getHlsGroupId()
    {
        if(!$this->hls_group_id){
            return null;
        }

        return StreamOptions::HLS_GROUP_ID . '=' . $this->hls_group_id;
    }

    /**
     * @param string $hls_group_id
     * @return HLSStream
     */
    public function setHlsGroupId(string $hls_group_id): HLSStream
    {
        $this->hls_group_id = $hls_group_id;
        return $this;
    }

    /**
     * @return string
     */
    protected function getPlaylistName()
    {
        if(!$this->playlist_name){
            return null;
        }

        return StreamOptions::PLAYLIST_NAME . '=' . $this->playlist_name;
    }

    /**
     * @param string $playlist_name
     * @return HLSStream
     */
    public function setPlaylistName(string $playlist_name): HLSStream
    {
        $this->playlist_name = $playlist_name;
        return $this;
    }

    /**
     * @return string
     */
    protected function getIframePlaylistName()
    {
        if(!$this->iframe_playlist_name){
            return null;
        }

        return StreamOptions::IFRAME_PLAYLIST_NAME . '=' . $this->iframe_playlist_name;
    }

    /**
     * @param string $iframe_playlist_name
     * @return HLSStream
     */
    public function setIframePlaylistName(string $iframe_playlist_name): HLSStream
    {
        $this->iframe_playlist_name = $iframe_playlist_name;
        return $this;
    }

    /**
     * @return string
     */
    protected function getHlsCharacteristics()
    {
        if(!$this->hls_characteristics){
            return null;
        }

        return StreamOptions::HLS_CHARACTERISTICS . '=' . $this->hls_characteristics;
    }

    /**
     * @param string $hls_characteristics
     * @return HLSStream
     */
    public function setHlsCharacteristics(string $hls_characteristics): HLSStream
    {
        $this->hls_characteristics = $hls_characteristics;
        return $this;
    }

}