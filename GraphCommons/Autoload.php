<?php
namespace GraphCommons;

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

    final public function register(): self
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

            require($file);
        });

        return self::$instance;
    }
}

// auto-init for including
return Autoload::init();
