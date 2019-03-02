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


use Shaka\Exception\ProcessException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process as SymphonyProcess;

class Process
{

    protected $commands = [];

    /**
     * ShakaProcess constructor.
     * @param $binary
     * @throws ProcessException
     */
    public function __construct($binary)
    {
        $this->commands[] = $this->getBinary($binary);
    }

    /**
     * @param $binary
     * @return mixed
     * @throws ProcessException
     */
    private function getBinary($binary)
    {
        if (is_executable($binary)) {
            return $binary;
        } else {
            $finder = new ExecutableFinder();

            if ($binary = $finder->find($binary)) {
                return $binary;
            } else {
                throw new ProcessException("We could not find 'Shaka Packager' binary.\nPlease check the path to the shaka binary");
            }
        }
    }

    /**
     * @throws ProcessException
     */
    public function run()
    {
        $commands = $this->getCommand();

        if (!is_executable(current($commands))) {
            throw new ProcessException('The binary is not executable');
        }

        $process = new SymphonyProcess($commands);
        $process->run();

        if (!$process->isSuccessful()) {
            $error = sprintf('The command "%s" failed.' . "\n\nExit Code: %s(%s)\n\nWorking directory: %s",
                $process->getCommandLine(),
                $process->getExitCode(),
                $process->getExitCodeText(),
                $process->getWorkingDirectory()
            );

            throw new ProcessException($error);
        }

        return $process->getOutput();
    }

    /**
     * @param array | string $command
     * @return Process
     */
    public function addCommand($command): Process
    {
        if (is_array($command)) {
            $this->commands = array_merge($this->commands, $command);
        } else {
            $this->commands[] = $command;
        }
        return $this;
    }

    /**
     * @param array $command
     * @return Process
     */
    public function removeCommand($command): Process
    {
        if (false !== ($key = array_search($command, $this->commands))) {
            unset($this->commands[$key]);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getCommand(): array
    {
        return $this->commands;
    }
}