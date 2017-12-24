<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitffb0159981c31991e75607b4cba85db9
{
    public static $prefixLengthsPsr4 = array (
        'U' =>
        array (
            'UserAccessManager\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'UserAccessManager\\' =>
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitffb0159981c31991e75607b4cba85db9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitffb0159981c31991e75607b4cba85db9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
