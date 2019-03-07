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


class ExportOptions implements OptionInterface
{
    /**
     * @return array
     */
    public function export()
    {
        $options = [];
        $get_methods = preg_grep('/^__get/', get_class_methods($this));

        foreach ($get_methods as $method) {
            if (null !== ($option = $this->{$method}())) {
                $options = array_merge($options, $option);
            }
        }

        return $options;
    }
}