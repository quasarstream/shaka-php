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


abstract class BuildStream implements StreamInterface
{

    /**
     * @return string
     */
    public function build()
    {
        $stream = '';
        $get_methods = preg_grep('/^get/', get_class_methods($this));

        foreach ($get_methods as $method) {
            if (null !== ($descriptor = $this->{$method}())) {
                if ($method == 'getInput') {
                    $stream = $descriptor . $stream;
                    continue;
                }
                $stream .= ',' . $descriptor;
            }
        }

        return $stream;
    }
}