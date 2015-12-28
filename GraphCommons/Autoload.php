<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Graph Commons & contributors.
 *     <http://graphcommons.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace GraphCommons;

// add simply php version check
if ('7' != PHP_VERSION[0]) {
    throw new \RuntimeException('GraphCommons-PHP requires minimum PHP 7 version!');
}

/**
 * @package GraphCommons
 * @object  GraphCommons\Autoload
 * @author  Kerem Güneş <qeremy@gmail.com>
 */
final class Autoload
{
    /**
     * Singleton thing.
     * @var GraphCommons\Autoload
     */
    private static $instance;

    /**
     * Idle init stoppers.
     */
    final private function __clone() {}
    final private function __construct() {}

    /**
     * Initializer.
     *
     * @return GraphCommons\Autoload
     */
    final public static function init(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Registrar.
     *
     * @return void
     */
    final public function register()
    {
        spl_autoload_register(function($name) {
            // fix root
            if ($name[0] != '\\') {
                $name = '\\'. $name;
            }

            // only self files
            if (1 !== strpos($name, __namespace__)) {
                return;
            }

            // prepare file name & path
            $name = substr($name, 1 + strlen(__namespace__));
            $file = sprintf('%s/%s.php', __dir__, str_replace('\\', '/', $name));

            // check file is exists
            if (!is_file($file)) {
                throw new \RuntimeException(sprintf(
                    'Object file not found! object(%s) file(%s)',
                    $name, $file
                ));
            }

            require($file);
        });
    }
}

// auto-init for including
return Autoload::init();
