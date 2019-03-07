<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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