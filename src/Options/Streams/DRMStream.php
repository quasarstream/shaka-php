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


class DRMStream extends Stream
{
    /** @var string */
    private $skip_encryption;

    /** @var string */
    private $drm_label;

    /**
     * @return string
     */
    protected function getSkipEncryption()
    {
        if (!$this->skip_encryption) {
            return null;
        }

        return StreamOptions::SKIP_ENCRYPTION . '=' . $this->skip_encryption;
    }

    /**
     * @param string $skip_encryption
     * @return $this
     */
    public function setSkipEncryption(string $skip_encryption)
    {
        $this->skip_encryption = $skip_encryption;
        return $this;
    }

    /**
     * @return string
     */
    protected function getDrmLabel()
    {
        if (!$this->drm_label) {
            return null;
        }

        return StreamOptions::DRM_LABEL . '=' . $this->drm_label;
    }

    /**
     * @param string $drm_label
     * @return $this
     */
    public function setDrmLabel(string $drm_label)
    {
        $this->drm_label = $drm_label;
        return $this;
    }
}