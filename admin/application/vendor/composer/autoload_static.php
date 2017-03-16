<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit196d4c3cb7278adaf3e2ec42b46db7e9
{
    public static $classMap = array (
        'Pusher' => __DIR__ . '/..' . '/pusher/pusher-php-server/lib/Pusher.php',
        'PusherException' => __DIR__ . '/..' . '/pusher/pusher-php-server/lib/Pusher.php',
        'PusherInstance' => __DIR__ . '/..' . '/pusher/pusher-php-server/lib/Pusher.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit196d4c3cb7278adaf3e2ec42b46db7e9::$classMap;

        }, null, ClassLoader::class);
    }
}