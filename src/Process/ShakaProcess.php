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

namespace Shaka\Process;

use Symfony\Component\Process\Process;

class ShakaProcess extends Process
{
    private $command = [];

    public function __construct($command, string $cwd = null, array $env = null, $input = null, ?float $timeout = 60)
    {
        $this->command[] = $command;
        parent::__construct($this->command , $cwd, $env, $input, $timeout);
    }

    /**
     * @param array $command
     * @return ShakaProcess
     */
    public function addCommand($command): ShakaProcess
    {
        $this->command[] = $command;
        return $this;
    }

    /**
     * @return array
     */
    public function getCommand(): array
    {
        return $this->command;
    }


}