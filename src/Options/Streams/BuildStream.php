<?php

/**
 * This file is part of the Shaka-PHP package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Shaka\Options\Streams;


abstract class BuildStream implements StreamInterface
{

    /**
     * @return string
     */
    public function build()
    {
        $stream = '';
        $get_methods = preg_grep('/^__get/', get_class_methods($this));

        foreach ($get_methods as $method) {

            if (null !== ($descriptor = $this->{$method}())) {
                if ($method == '__getInput') {
                    $stream = $descriptor . $stream;
                    continue;
                }

                $stream .= ',' . $descriptor;
            }
        }

        return str_replace(" ", "", $stream);
    }
}