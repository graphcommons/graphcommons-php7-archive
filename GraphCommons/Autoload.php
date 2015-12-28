<?php
namespace GraphCommons;

if (PHP_VERSION[0] != '7') {
    throw new \RuntimeException('GraphCommons-PHP requires minimum PHP 7 version!');
}

final class Autoload
{
    private static $instance;

    final private function __clone() {}
    final private function __construct() {}

    final public static function init(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

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
