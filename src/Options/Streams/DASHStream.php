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


class DASHStream extends DRMStream
{
    /** @var string */
    private $dash_roles;

    /**
     * @param string $dash_roles
     * @return DASHStream
     */
    public function setDashRoles(string $dash_roles): DASHStream
    {
        $this->dash_roles = $dash_roles;
        return $this;
    }

    /**
     * @return string
     */
    protected function getDashRoles()
    {
        if(!$this->dash_roles){
            return null;
        }

        return StreamOptions::DASH_ROLES . '=' . $this->dash_roles;
    }
}