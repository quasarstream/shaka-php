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


namespace Shaka\Options\Traits;


use Shaka\Options\MediaOptions;

trait AdInsertion
{
    /** @var string*/
    private $ad_cues;

    /**
     * @param string $ad_cues
     * @return AdInsertion
     */
    public function setAdCues(string $ad_cues)
    {
        $this->ad_cues = $ad_cues;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdCues()
    {
        if (!$this->ad_cues) {
            return null;
        }

        return [MediaOptions::AD_CUES, $this->ad_cues];
    }
}